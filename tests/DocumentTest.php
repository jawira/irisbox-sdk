<?php

namespace Jawira\IrisboxSdkTests;

use Jawira\IrisboxSdk\DocumentModel;
use Jawira\IrisboxSdk\DocumentService;
use PHPUnit\Framework\TestCase;
use function base64_encode;
use function file_get_contents;

class DocumentTest extends TestCase
{
  private static DocumentService $documentService;

  public static function setUpBeforeClass(): void
  {
    $username = getenv('IRISBOX_USERNAME');
    $password = getenv('IRISBOX_PASSWORD');
    DocumentTest::$documentService = new DocumentService($username, $password, DocumentService::STAGING);
  }

  private function generateFormDetails(): DocumentModel\FormDetails
  {
    $form = new DocumentModel\FormDetails();
    $form->formName = getenv('IRISBOX_FORM_NAME');
    $form->applicationName = getenv('IRISBOX_APPLICATION_NAME');
    return $form;
  }

  /**
   * @covers \Jawira\IrisboxSdk\IrisboxService
   * @covers \Jawira\IrisboxSdk\DocumentService
   * @covers \Jawira\IrisboxSdk\Soap\DocumentClient
   */
  public function testGetDemandPdf()
  {
    $request = new DocumentModel\GetDemandPDFRequest();
    $request->form = $this->generateFormDetails();
    $request->demandUniqueKey = '2dce55af1fa84188a517a5996b778cc686929085';

    $response = self::$documentService->getDemandPdf($request);

    $this->assertInstanceOf(DocumentModel\GetDemandPDFResponse::class, $response);
    $this->assertSame('PrAc-241107-38853', $response->filename);
    $this->assertInstanceOf(DocumentModel\Attachment::class, $response->demandPDF);
  }

  /**
   * @covers \Jawira\IrisboxSdk\IrisboxService
   * @covers \Jawira\IrisboxSdk\DocumentService
   * @covers \Jawira\IrisboxSdk\Soap\DocumentClient
   */
  public function testGetAttachments()
  {
    $request = new DocumentModel\GetAttachmentsRequest();
    $request->form = $this->generateFormDetails();
    $request->demandUniqueKey = '2dce55af1fa84188a517a5996b778cc686929085';

    $response = self::$documentService->getAttachments($request);

    $this->assertInstanceOf(DocumentModel\GetAttachmentsResponse::class, $response);
    $this->assertIsArray($response->attachments);
    $this->assertSame(1, count($response->attachments));
  }

  /**
   * @covers \Jawira\IrisboxSdk\IrisboxService
   * @covers \Jawira\IrisboxSdk\DocumentService
   * @covers \Jawira\IrisboxSdk\Soap\DocumentClient
   */
  public function testSetDemandStatusWithAttachmentsRequest()
  {
    $attachment = new DocumentModel\Attachment();
    $attachment->filename = 'jawira-phpunit.pdf';
    $attachment->mediaType = 'application/pdf';
    $attachment->file = base64_encode(file_get_contents(__DIR__ . '/../resources/jawira.pdf'));

    $request = new DocumentModel\SetDemandStatusWithAttachmentsRequest();
    $request->form = $this->generateFormDetails();
    $request->demandUniqueKey = '2dce55af1fa84188a517a5996b778cc686929085';
    $request->status = 'RECEIVED';
    $request->attachments = [$attachment];

    $response = self::$documentService->setDemandStatusWithAttachments($request);

    $this->assertInstanceOf(DocumentModel\SetDemandStatusWithAttachmentsResponse::class, $response);
    $this->assertSame('true', $response->response);
  }
}
