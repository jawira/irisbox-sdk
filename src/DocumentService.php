<?php declare(strict_types=1);

namespace Jawira\IrisboxSdk;

use Jawira\IrisboxSdk\Soap\DemandClient;
use Jawira\IrisboxSdk\Soap\DocumentClient;

class DocumentService extends IrisboxService
{
  public const STAGING = 'https://irisbox.irisnetlab.be/irisbox/ws/backoffice/demand/irisboxBackOfficeAttachmentWebService.wsdl';
  public const PRODUCTION = 'https://irisbox.irisnet.be/irisbox/ws/backoffice/demand/irisboxBackOfficeAttachmentWebService.wsdl';

  private ?DocumentClient $soapClient= null;

  public function getAttachments(DocumentModel\GetAttachmentsRequest $request): DocumentModel\GetAttachmentsResponse
  {
    return $this->getClient()->getAttachments($request);
  }

  public function getDemandPdf(DocumentModel\GetDemandPDFRequest $request): DocumentModel\GetDemandPDFResponse
  {
    return $this->getClient()->getDemandPdf($request);
  }

  public function setDemandStatusWithAttachments(DocumentModel\SetDemandStatusWithAttachmentsRequest $request): DocumentModel\SetDemandStatusWithAttachmentsResponse
  {
    return $this->getClient()->setDemandStatusWithAttachments($request);
  }

  private function getClient()
  {
    if ($this->soapClient instanceof DocumentClient) {
      return $this->soapClient;
    }
    $this->soapClient = new DocumentClient($this->wsdl);
    $this->soapClient->setCredentials($this->username, $this->password);

    return $this->soapClient;
  }
}
