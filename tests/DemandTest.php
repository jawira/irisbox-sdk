<?php

namespace Jawira\IrisboxSdkTests;

use Jawira\IrisboxSdk\DemandModel\Demand;
use Jawira\IrisboxSdk\DemandModel\FormDetails;
use Jawira\IrisboxSdk\DemandModel\GetDemandRequest;
use Jawira\IrisboxSdk\DemandModel\GetDemandResponse;
use Jawira\IrisboxSdk\DemandModel\GetDemandsBetweenDatesRequest;
use Jawira\IrisboxSdk\DemandModel\GetDemandsBetweenDatesResponse;
use Jawira\IrisboxSdk\DemandModel\GetDemandsByStatusRequest;
use Jawira\IrisboxSdk\DemandModel\GetDemandsByStatusResponse;
use Jawira\IrisboxSdk\DemandModel\GetFormXsdRequest;
use Jawira\IrisboxSdk\DemandModel\GetFormXsdResponse;
use Jawira\IrisboxSdk\DemandModel\SetDemandInternalReferenceRequest;
use Jawira\IrisboxSdk\DemandModel\SetDemandInternalReferenceResponse;
use Jawira\IrisboxSdk\DemandModel\SetDemandStatusRequest;
use Jawira\IrisboxSdk\DemandModel\SetDemandStatusResponse;
use Jawira\IrisboxSdk\DemandService;
use PHPUnit\Framework\TestCase;

class DemandTest extends TestCase
{
  private static DemandService $demandService;

  public static function setUpBeforeClass(): void
  {
    $username = getenv('IRISBOX_USERNAME');
    $password = getenv('IRISBOX_PASSWORD');
    DemandTest::$demandService = new DemandService($username, $password, DemandService::STAGING);
  }

  private function generateFormDetails(): FormDetails
  {
    $form = new FormDetails();
    $form->formName = getenv('IRISBOX_FORM_NAME');
    $form->applicationName = getenv('IRISBOX_APPLICATION_NAME');
    return $form;
  }

  /**
   * @covers \Jawira\IrisboxSdk\IrisboxService
   * @covers \Jawira\IrisboxSdk\DemandService
   * @covers \Jawira\IrisboxSdk\Soap\DemandClient
   */
  public function testGetDemandsBetweenDates()
  {
    $request = new GetDemandsBetweenDatesRequest();
    $request->form = $this->generateFormDetails();
    $request->startDate = '2024-01-01';
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
    $request->demandUniqueKey = '2dce55af1fa84188a517a5996b778cc686929085';

    $response = self::$demandService->GetDemand($request);

    $this->assertInstanceOf(GetDemandResponse::class, $response);
    $this->assertInstanceOf(Demand::class, $response->irisboxDemand);
    $this->assertEquals('2dce55af1fa84188a517a5996b778cc686929085', $response->irisboxDemand->uniqueKey);
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
    $request->startDate = '2024-01-01';
    $request->endDate = '2024-12-31';
    $request->status = 'RECEIVED';

    $response = self::$demandService->GetDemandsByStatus($request);

    $this->assertInstanceOf(GetDemandsByStatusResponse::class, $response);
    $this->assertEquals(0, $response->currentPage);
    $this->assertEquals(0, $response->totalPages);
  }

  /**
   * @covers \Jawira\IrisboxSdk\IrisboxService
   * @covers \Jawira\IrisboxSdk\DemandService
   * @covers \Jawira\IrisboxSdk\Soap\DemandClient
   */
  public function testGetFormXsd()
  {
    $request = new GetFormXsdRequest();
    $request->form = $this->generateFormDetails();
    $request->version = 0;
    $response = self::$demandService->getFormXsd($request);

    $this->assertInstanceOf(GetFormXsdResponse::class, $response);
    $this->assertStringStartsWith('<xs:schema xmlns:xs', $response->xsd);
  }

  /**
   * @covers \Jawira\IrisboxSdk\IrisboxService
   * @covers \Jawira\IrisboxSdk\DemandService
   * @covers \Jawira\IrisboxSdk\Soap\DemandClient
   */
  public function testSetInternalReference()
  {
    $request = new SetDemandInternalReferenceRequest();
    $request->form = $this->generateFormDetails();
    $request->demandUniqueKey = '2dce55af1fa84188a517a5996b778cc686929085';
    $request->internalReference = 'my-internal-reference';

    $response = self::$demandService->setDemandInternalReference($request);
    $this->assertInstanceOf(SetDemandInternalReferenceResponse::class, $response);
    $this->assertSame(true, $response->internalReferenceSet);
  }

  /**
   * @covers \Jawira\IrisboxSdk\IrisboxService
   * @covers \Jawira\IrisboxSdk\DemandService
   * @covers \Jawira\IrisboxSdk\Soap\DemandClient
   */
  public function testSetDemandStatus()
  {
    $request = new SetDemandStatusRequest();
    $request->form = $this->generateFormDetails();
    $request->demandUniqueKey = '2dce55af1fa84188a517a5996b778cc686929085';
    $request->message = 'The demand has been received. Please be patient.';
    $request->status = 'RECEIVED';

    $response = self::$demandService->setDemandStatus($request);
    $this->assertInstanceOf(SetDemandStatusResponse::class, $response);
    $this->assertSame(true, $response->response);
  }
}
