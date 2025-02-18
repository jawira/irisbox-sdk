<?php declare(strict_types=1);

namespace Jawira\IrisboxSdk\Soap;

use Jawira\IrisboxSdk\DocumentModel\GetDemandPDFRequest;
use Jawira\IrisboxSdk\DocumentModel\GetDemandPDFResponse;
use RuntimeException;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use function curl_close;
use function curl_errno;
use function curl_error;
use function curl_exec;
use function curl_init;
use function is_bool;
use function sprintf;

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
    $soapRequest = $this->getSerializer()->serialize($request, 'xml');
    var_dump($soapRequest);
  }

  private function prepareEnvelope(string $soapBody): string
  {
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
          <soapenv:Body>%s</soapenv:Body>
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
    $normalizers = [new DateTimeNormalizer(), new ObjectNormalizer()];
    $this->serializer = new Serializer($normalizers, $encoders);

    return $this->serializer;
  }

}

