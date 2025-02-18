<?php declare(strict_types=1);

namespace Jawira\IrisboxSdk\DocumentModel;

class GetDemandPDFResponse
{
  public ?string $filename = null;

  /**
   * The demandPDF.
   *
   * Meta information extracted from the WSDL
   *
   * - expectedContentTypes: application/octet-stream
   * - nillable: true
   */
  public ?string $demandPDF = null;
}
