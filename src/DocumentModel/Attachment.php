<?php declare(strict_types=1);

namespace Jawira\IrisboxSdk\DocumentModel;

class Attachment
{
  public ?string $filename = null;
  public ?string $mediaType = null;
  /**
   * Meta information extracted from the WSDL.
   *
   * - expectedContentTypes: application/octet-stream
   * - nillable: true
   */
  public ?string $file = null;
}
