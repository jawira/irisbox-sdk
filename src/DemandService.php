<?php declare(strict_types=1);

namespace Jawira\IrisboxSdk;

use Jawira\IrisboxSdk\DemandModel\GetDemandsBetweenDatesRequest;
use Jawira\IrisboxSdk\DemandModel\GetDemandsBetweenDatesResponse;
use SoapFault;

/**
 * @api
 */
class DemandService extends AbstractService
{
  public const STAGING = 'https://irisbox.irisnetlab.be/irisbox/ws/backoffice/demand/irisboxBackOfficeWebService.wsdl';
  public const PRODUCTION = 'https://irisbox.irisnet.be/irisbox/ws/backoffice/demand/irisboxBackOfficeWebService.wsdl';


  public function GetDemandsBetweenDates(GetDemandsBetweenDatesRequest $getDemandsBetweenDatesRequest): GetDemandsBetweenDatesResponse|SoapFault
  {
    return $this->getClient()->__soapCall(__FUNCTION__, [$getDemandsBetweenDatesRequest]);
  }

  public function getClassmap(): array
  {
    return [
      'GetDemandRequest' => DemandModel\GetDemandRequest::class,
      'GetDemandResponse' => DemandModel\GetDemandResponse::class,
      'GetDemandsBetweenDatesRequest' => DemandModel\GetDemandsBetweenDatesRequest::class,
      'GetDemandsBetweenDatesResponse' => DemandModel\GetDemandsBetweenDatesResponse::class,
      'GetDemandsByStatusRequest' => DemandModel\GetDemandsByStatusRequest::class,
      'GetDemandsByStatusResponse' => DemandModel\GetDemandsByStatusResponse::class,
      'GetFormXSDRequest' => DemandModel\GetFormXSDRequest::class,
      'GetFormXSDResponse' => DemandModel\GetFormXSDResponse::class,
      'SetDemandInternalReferenceRequest' => DemandModel\SetDemandInternalReferenceRequest::class,
      'SetDemandInternalReferenceResponse' => DemandModel\SetDemandInternalReferenceResponse::class,
      'SetDemandStatusRequest' => DemandModel\SetDemandStatusRequest::class,
      'SetDemandStatusResponse' => DemandModel\SetDemandStatusResponse::class,
      'demand' => DemandModel\Demand::class,
      'formDetails' => DemandModel\FormDetails::class,
    ];
  }
}
