<?php

namespace Jawira\IrisboxClient\Toolbox;

use Jawira\IrisboxClient\DemandModel;

class ClassMaps
{
  public static array $demandClassMaps = [
    'formDetails' => DemandModel\FormDetails::class,
    'SetDemandStatusRequest' => DemandModel\SetDemandStatusRequest::class,
    'SetDemandStatusResponse' => DemandModel\SetDemandStatusResponse::class,
    'GetDemandsBetweenDatesRequest' => DemandModel\GetDemandsBetweenDatesRequest::class,
    'GetDemandsBetweenDatesResponse' => DemandModel\GetDemandsBetweenDatesResponse::class,
    'GetDemandsByStatusRequest' => DemandModel\GetDemandsByStatusRequest::class,
    'GetDemandsByStatusResponse' => DemandModel\GetDemandsByStatusResponse::class,
    'demand' => DemandModel\Demand::class,
    'GetFormXSDRequest' => DemandModel\GetFormXSDRequest::class,
    'GetFormXSDResponse' => DemandModel\GetFormXSDResponse::class,
    'GetDemandRequest' => DemandModel\GetDemandRequest::class,
    'GetDemandResponse' => DemandModel\GetDemandResponse::class,
    'SetDemandInternalReferenceRequest' => DemandModel\SetDemandInternalReferenceRequest::class,
    'SetDemandInternalReferenceResponse' => DemandModel\SetDemandInternalReferenceResponse::class,
  ];

}
