<?php declare(strict_types=1);

namespace Jawira\IrisboxSdk;

/**
 * @api
 */
class DemandService extends AbstractService
{
  public const STAGING = 'https://irisbox.irisnetlab.be/irisbox/ws/backoffice/demand/irisboxBackOfficeWebService.wsdl';
  public const PRODUCTION = 'https://irisbox.irisnet.be/irisbox/ws/backoffice/demand/irisboxBackOfficeWebService.wsdl';


  public function getDemandsBetweenDates(DemandModel\GetDemandsBetweenDatesRequest $request): DemandModel\GetDemandsBetweenDatesResponse
  {
    return $this->getClient()->__soapCall('GetDemandsBetweenDates', [$request]);
  }

  public function getDemand(DemandModel\GetDemandRequest $request): DemandModel\GetDemandResponse
  {
    return $this->getClient()->__soapCall('GetDemand', [$request]);
  }

  public function getDemandsByStatus(DemandModel\GetDemandsByStatusRequest $request): DemandModel\GetDemandsByStatusResponse
  {
    return $this->getClient()->__soapCall('GetDemandsByStatus', [$request]);
  }

  public function getFormXsd(DemandModel\GetFormXsdRequest $request): DemandModel\GetFormXsdResponse
  {
    return $this->getClient()->__soapCall('GetFormXSD', [$request]);
  }

  public function setDemandInternalReference(DemandModel\SetDemandInternalReferenceRequest $request): DemandModel\SetDemandInternalReferenceResponse
  {
    return $this->getClient()->__soapCall('SetDemandInternalReference', [$request]);
  }

  public function setDemandStatus(DemandModel\SetDemandStatusRequest $request): DemandModel\SetDemandStatusResponse
  {
    return $this->getClient()->__soapCall('SetDemandStatus', [$request]);
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
      'GetFormXSDRequest' => DemandModel\GetFormXsdRequest::class,
      'GetFormXSDResponse' => DemandModel\GetFormXsdResponse::class,
      'SetDemandInternalReferenceRequest' => DemandModel\SetDemandInternalReferenceRequest::class,
      'SetDemandInternalReferenceResponse' => DemandModel\SetDemandInternalReferenceResponse::class,
      'SetDemandStatusRequest' => DemandModel\SetDemandStatusRequest::class,
      'SetDemandStatusResponse' => DemandModel\SetDemandStatusResponse::class,
      'demand' => DemandModel\Demand::class,
      'formDetails' => DemandModel\FormDetails::class,
    ];
  }
}
