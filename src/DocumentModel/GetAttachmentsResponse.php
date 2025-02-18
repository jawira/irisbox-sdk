<?php declare(strict_types=1);

namespace Jawira\IrisboxSdk\DocumentModel;

class GetAttachmentsResponse
{
  /**
   * The attachments.
   *
   * Meta information extracted from the WSDL
   *
   * - maxOccurs: unbounded
   * - minOccurs: 0
   *
   * @var \Jawira\IrisboxSdk\DocumentModel\Attachment[]
   */
  public ?array $attachments = null;
}
