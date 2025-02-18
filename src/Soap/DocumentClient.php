<?php declare(strict_types=1);

namespace Jawira\IrisboxSdk\Soap;

use Jawira\IrisboxSdk\DocumentModel\Attachment;
use Jawira\IrisboxSdk\DocumentModel\GetDemandPDFRequest;
use Jawira\IrisboxSdk\DocumentModel\GetDemandPDFResponse;
use Riverline\MultiPartParser\StreamedPart;
use RuntimeException;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AttributeLoader;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use function curl_close;
use function curl_errno;
use function curl_error;
use function curl_exec;
use function curl_init;
use function is_bool;
use function preg_replace;
use function sprintf;
use function str_replace;
use const XML_PI_NODE;

/**
 * Irisbox Document client.
 *
 * Document server uses "Soap with Attachments" (SwA) mechanism. Since Soap
 * extension cannot handle this, a low-level implementation is needed.
 */
class DocumentClient implements SoapClientInterface
{
  private ?Serializer $serializer = null;
  private string $username = '';
  private string $password = '';

  public function setCredentials(string $username, string $password): void
  {
    $this->username = $username;
    $this->password = $password;
  }

  public function getDemandPdf(GetDemandPDFRequest $request): GetDemandPDFResponse
  {
    $context = [
      'xml_standalone' => false,
      'xml_root_prefix' => 'v1',
      'xml_format_output' => true,
      'xml_root_node_name' => 'GetDemandPDFRequest',
      'encoder_ignored_node_types' => [XML_PI_NODE],
    ];
    $body = $this->getSerializer()->serialize($request, 'xml', $context);
    $envelope = $this->prepareEnvelope($body);
    $httpResponse = $this->doRequest($envelope, 'https://irisbox.irisnetlab.be/irisbox/ws/backoffice/demand/attachment');
    $parts = $this->extractParts($httpResponse);
    foreach ($parts as $part) {
      if ($part->getMimeType() === 'application/xop+xml') {
        $demandPdfResponse = $this->getSerializer()->deserialize($part->getBody(), GetDemandPDFResponse::class, 'xml');
        continue;
      }
      if ($demandPdfResponse instanceof GetDemandPDFResponse && $part->getMimeType() === 'application/pdf') {
        $attachment = new Attachment();
        $attachment->file = $part->getBody();
        $attachment->filename = $demandPdfResponse->filename;
        $attachment->mediaType = $part->getMimeType();
        $demandPdfResponse->demandPDF = $attachment;
        continue;
      }
    }
    return $demandPdfResponse;
  }

  /**
   * @return \Riverline\MultiPartParser\StreamedPart[]
   */
  private function extractParts(string $data): array
  {
    $stream = fopen('php://temp', 'rw');
    fwrite($stream, $data);
    rewind($stream);

    $document = new StreamedPart($stream);

    if ($document->isMultiPart()) {
      return $document->getParts();
    }

    return [];
  }

  private function prepareEnvelope(string $soapBody): string
  {
    $soapBody = preg_replace('#<\b#', '<v1:', $soapBody);
    $soapBody = preg_replace('#</\b#', '</v1:', $soapBody);
    $template = <<<'XML'
        <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"
                  xmlns:v1="http://schemas.cirb.brussels/irisbox/ws/backoffice/attachment/v1">
          <soapenv:Header>
            <wsse:Security xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"
                           xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">
              <wsse:UsernameToken>
                <wsse:Username>%s</wsse:Username>
                <wsse:Password>%s</wsse:Password>
              </wsse:UsernameToken>
            </wsse:Security>
          </soapenv:Header>
          <soapenv:Body>
            %s
          </soapenv:Body>
        </soapenv:Envelope>
        XML;

    return sprintf($template, $this->username, $this->password, $soapBody);
  }

  private function doRequest(string $soapEnvelop, string $url): string
  {
    $curlHandle = curl_init();
    curl_setopt($curlHandle, CURLOPT_URL, $url);
    curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curlHandle, CURLOPT_HEADER, true);
    curl_setopt($curlHandle, CURLOPT_POST, true);
    curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $soapEnvelop);
    curl_setopt($curlHandle, CURLOPT_HTTPHEADER, ['Content-Type: text/xml']);

    $response = curl_exec($curlHandle);

    if (is_bool($response) || 0 !== curl_errno($curlHandle)) {
      throw new RuntimeException(curl_error($curlHandle));
    }

    curl_close($curlHandle);

    return $response;
  }

  public function getSerializer(): Serializer
  {
    if ($this->serializer instanceof Serializer) {
      return $this->serializer;
    }

    $encoders = [new XmlEncoder(), new JsonEncoder()];
    $normalizers = [
      new ArrayDenormalizer(),
      new ObjectNormalizer(
        classMetadataFactory:  new ClassMetadataFactory(new AttributeLoader()),
        propertyTypeExtractor: new PhpDocExtractor(),
      ),
    ];
    $this->serializer = new Serializer($normalizers, $encoders);

    return $this->serializer;
  }

}

