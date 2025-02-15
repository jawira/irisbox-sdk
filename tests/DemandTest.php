<?php
namespace Jawira\IrisboxClientTests;

use Jawira\IrisboxClient\DemandModel\GetDemandsBetweenDatesRequest;
use Jawira\IrisboxClient\DemandModel\GetDemandsBetweenDatesResponse;
use SoapFault;

class DemandTest extends IrisboxCase
{

  /**
   * @covers \Jawira\IrisboxClient\DemandService::GetDemandsBetweenDates
   * @covers \Jawira\IrisboxClient\Toolbox\IrisboxSoapClient
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
