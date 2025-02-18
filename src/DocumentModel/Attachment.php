<?php declare(strict_types=1);

namespace Jawira\IrisboxSdk\DocumentModel;

use Symfony\Component\Serializer\Attribute;

class Attachment
{
  #[Attribute\SerializedPath('[ns2:filename]')]
  public ?string $filename = null;
  #[Attribute\SerializedPath('[ns2:mediaType]')]
  public ?string $mediaType = null;
  /**
   * Meta information extracted from the WSDL.
   *
   * - expectedContentTypes: application/octet-stream
   * - nillable: true
   */
  public ?string $file = null;
}
