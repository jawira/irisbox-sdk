<?php declare(strict_types=1);

namespace Jawira\IrisboxSdk;

use Jawira\IrisboxSdk\Soap\IrisboxSoapClient;
use WsdlToPhp\WsSecurity\WsSecurity;

abstract class AbstractService
{
  private ?IrisboxSoapClient $soapClient = null;

  public function __construct(
    private readonly string $username,
    private readonly string $password,
    private readonly string $wsdl,
  )
  {
  }

  protected function getClient()
  {
    if ($this->soapClient instanceof IrisboxSoapClient) {
      return $this->soapClient;
    }

    // Create client
    $options = [
      'trace' => true,
      'exceptions' => true,
    ];
    $options['classmap'] = $this->getClassmap();
    $this->soapClient = new IrisboxSoapClient($this->wsdl, $options);

    // Add headers
    $wsSecurity = new WsSecurity($this->username, $this->password, passwordDigest: false, addNonce: false);
    $wsSecurity->getSecurity()->getUsernameToken()->setAttribute('wsu:Id', 'UsernameToken');
    $header = $wsSecurity->getSoapHeader();
    $this->soapClient->__setSoapHeaders($header);

    return $this->soapClient;
  }

  abstract public function getClassmap(): array;
}
