<?php

namespace Jawira\IrisboxSdkTests;

use Jawira\IrisboxSdk\DemandModel\Demand;
use Jawira\IrisboxSdk\DemandModel\GetDemandRequest;
use Jawira\IrisboxSdk\DemandModel\GetDemandResponse;
use Jawira\IrisboxSdk\DemandModel\GetDemandsBetweenDatesRequest;
use Jawira\IrisboxSdk\DemandModel\GetDemandsBetweenDatesResponse;
use Jawira\IrisboxSdk\DemandModel\GetDemandsByStatusRequest;
use Jawira\IrisboxSdk\DemandModel\GetDemandsByStatusResponse;

class DemandTest extends IrisboxCase
{
  /**
   * @covers \Jawira\IrisboxSdk\IrisboxService
   * @covers \Jawira\IrisboxSdk\DemandService
   * @covers \Jawira\IrisboxSdk\Soap\DemandClient
   */
  public function testGetDemandsBetweenDates()
  {
    $request = new GetDemandsBetweenDatesRequest();
    $request->form = $this->generateFormDetails();
    $request->startDate = '2024-05-01';
    $request->endDate = '2024-12-31';
    $request->version = 0;
    $request->pageNumber = 0;

    $response = self::$demandService->GetDemandsBetweenDates($request);

    $this->assertInstanceOf(GetDemandsBetweenDatesResponse::class, $response);
    $this->assertCount(2, $response->irisboxDemands);
    $this->assertEquals(0, $response->currentPage);
    $this->assertEquals(0, $response->totalPages);
  }

  /**
   * @covers \Jawira\IrisboxSdk\IrisboxService
   * @covers \Jawira\IrisboxSdk\DemandService
   * @covers \Jawira\IrisboxSdk\Soap\DemandClient
   */
  public function testGetDemand()
  {
    $request = new GetDemandRequest();
    $request->form = $this->generateFormDetails();
    $request->demandUniqueKey = '1f0c2226bf55413481fa79fd5ee4de5a85572404';

    $response = self::$demandService->GetDemand($request);

    $this->assertInstanceOf(GetDemandResponse::class, $response);
    $this->assertInstanceOf(Demand::class, $response->irisboxDemand);
    $this->assertEquals('1f0c2226bf55413481fa79fd5ee4de5a85572404', $response->irisboxDemand->uniqueKey);
  }

  /**
   * @covers \Jawira\IrisboxSdk\IrisboxService
   * @covers \Jawira\IrisboxSdk\DemandService
   * @covers \Jawira\IrisboxSdk\Soap\DemandClient
   */
  public function testGetDemandsByStatus()
  {
    $request = new GetDemandsByStatusRequest();
    $request->form = $this->generateFormDetails();
    $request->startDate = '2024-05-01';
    $request->endDate = '2024-06-30';
    $request->status = 'RECEIVED';
    $request->version = 0;
    $request->pageNumber = 0;

    $response = self::$demandService->GetDemandsByStatus($request);

    $this->assertInstanceOf(GetDemandsByStatusResponse::class, $response);
    $this->assertEquals(0, $response->currentPage);
    $this->assertEquals(0, $response->totalPages);
  }
}
