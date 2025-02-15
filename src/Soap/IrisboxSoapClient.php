<?php declare(strict_types=1);

namespace Jawira\IrisboxSdk\Soap;

use DOMDocument;
use SoapClient;

/**
 * @internal
 */
class IrisboxSoapClient extends SoapClient
{
  public function __doRequest($request, $location, $action, $version, bool $oneWay = false): ?string
  {
    // Load the generated SOAP request into DOMDocument
    $dom = new DOMDocument();
    $dom->loadXML($request);

    // Hack to use proper namespace
    $xml = $dom->saveXML();
    $xml = str_replace('xmlns:ns1', 'xmlns:v1', $xml);
    $xml = str_replace('ns1:', 'v1:', $xml);

    return parent::__doRequest($xml, $location, $action, $version, $oneWay);
  }
}
