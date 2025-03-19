<?php declare(strict_types=1);

namespace Jawira\IrisboxSdk\DocumentModel;

use Symfony\Component\Serializer\Attribute\SerializedPath;

class SetDemandStatusWithAttachmentsResponse
{
  #[SerializedPath('[SOAP-ENV:Body][ns2:SetDemandStatusWithAttachmentsResponse][ns2:response]')]
  /**
   * Boolean as string.
   */
  public ?string $response = null;
}
