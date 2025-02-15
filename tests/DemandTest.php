<?php
namespace Jawira\IrisboxSdkTests;

use Jawira\IrisboxSdk\DemandModel\GetDemandsBetweenDatesRequest;
use Jawira\IrisboxSdk\DemandModel\GetDemandsBetweenDatesResponse;
use SoapFault;

class DemandTest extends IrisboxCase
{
  /**
   * @covers \Jawira\IrisboxSdk\AbstractService
   * @covers \Jawira\IrisboxSdk\DemandService
   * @covers \Jawira\IrisboxSdk\Soap\IrisboxSoapClient
   */
  public function testDemo()
  {
    $request = new GetDemandsBetweenDatesRequest();
    $request->form = $this->generateFormDetails();
    $request->startDate = '2024-05-01';
    $request->endDate = '2024-12-31';
    $request->version = 0;
    $request->pageNumber = 0;

    $response = self::$demandService->GetDemandsBetweenDates($request);

    if ($response instanceof SoapFault) {
      $this->fail($response->getMessage());
    }

    $this->assertInstanceOf(GetDemandsBetweenDatesResponse::class, $response);
    $this->assertCount(2,$response->irisboxDemands);
    $this->assertEquals($response->currentPage, 0);
    $this->assertEquals($response->totalPages, 0);
  }
}
