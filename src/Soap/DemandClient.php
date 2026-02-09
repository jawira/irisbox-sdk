<?php declare(strict_types=1);

namespace Jawira\IrisboxSdk\Soap;

use DOMDocument;
use SoapClient;
use WsdlToPhp\WsSecurity\WsSecurity;

/**
 * Demand client uses SOAP extension.
 */
class DemandClient extends SoapClient implements SoapClientInterface
{
  /**
   * Add username and password to Soap request.
   *
   * This method should only been called once, headers will persist between calls.
   */
  public function setCredentials(string $username, string $password): void
  {
    $wsSecurity = new WsSecurity($username, $password, passwordDigest: false, addNonce: false);
    $header = $wsSecurity->getSoapHeader();
    $this->__setSoapHeaders(); // clean up
    $this->__setSoapHeaders($header);
  }

  /**
   * Send Soap request.
   */
  public function __doRequest($request, $location, $action, $version, bool $oneWay = false, ?string $uriParserClass = null): ?string
  {
    $xml = $this->fixRequestNamespace($request);
    return parent::__doRequest($xml, $location, $action, $version, $oneWay, $uriParserClass);
  }

  /**
   * Fix Soap namespace.
   *
   * Irisbox will fail if wrong namespace is used.
   */
  private function fixRequestNamespace(string $request): string
  {
    // Load the generated SOAP request into DOMDocument
    $dom = new DOMDocument();
    $dom->loadXML($request);

    // Hack to use proper namespace
    $xml = $dom->saveXML();
    $xml = str_replace('xmlns:ns1', 'xmlns:v1', $xml);
    $xml = str_replace('ns1:', 'v1:', $xml);

    is_string($xml) or throw new \RuntimeException('Cannot fix namespace in invalid XML');

    return $xml;
  }
}

