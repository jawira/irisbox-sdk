<?php declare(strict_types=1);

namespace Jawira\IrisboxSdk\DocumentModel;


use Symfony\Component\Serializer\Attribute\SerializedPath;

class GetDemandPDFResponse
{
  #[SerializedPath('[SOAP-ENV:Body][ns2:GetDemandPDFResponse][ns2:filename]')]
  public ?string $filename = null;

  /**
   * The demandPDF.
   */
  public ?Attachment $demandPDF = null;
}
