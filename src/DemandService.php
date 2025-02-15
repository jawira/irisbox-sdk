<?php declare(strict_types=1);

namespace Jawira\IrisboxClient;

use Jawira\IrisboxClient\DemandModel\GetDemandsBetweenDatesRequest;
use Jawira\IrisboxClient\DemandModel\GetDemandsBetweenDatesResponse;
use Jawira\IrisboxClient\Toolbox\ClassMaps;
use Jawira\IrisboxClient\Toolbox\IrisboxSoapClient;
use SoapFault;
use WsdlToPhp\WsSecurity\WsSecurity;

/**
 * @api
 */
class DemandService
{
  public const STAGING = 'https://irisbox.irisnetlab.be/irisbox/ws/backoffice/demand/irisboxBackOfficeWebService.wsdl';
  public const PRODUCTION = 'https://irisbox.irisnet.be/irisbox/ws/backoffice/demand/irisboxBackOfficeWebService.wsdl';
  public readonly IrisboxSoapClient $soapClient;

  public function __construct(
    private readonly string $username,
    private readonly string $password,
    string                  $wsdl,
  )
  {
    $options = [
      'classmap' => ClassMaps::$demandClassMaps,
      'trace' => true,
      'exceptions' => false,
    ];
    $this->soapClient = new IrisboxSoapClient($wsdl, $options);

    $wsSecurity = new WsSecurity($this->username, $this->password, passwordDigest: false, addNonce: false);
    $wsSecurity->getSecurity()->getUsernameToken()->setAttribute('wsu:Id', 'UsernameToken');
    $header = $wsSecurity->getSoapHeader();

    $this->soapClient->__setSoapHeaders($header);
  }

  public function GetDemandsBetweenDates(GetDemandsBetweenDatesRequest $getDemandsBetweenDatesRequest): GetDemandsBetweenDatesResponse|SoapFault
  {
    return $this->soapClient->__soapCall(__FUNCTION__, [$getDemandsBetweenDatesRequest]);
  }
}
