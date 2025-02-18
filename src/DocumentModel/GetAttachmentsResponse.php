<?php declare(strict_types=1);

namespace Jawira\IrisboxSdk\DocumentModel;

use Symfony\Component\Serializer\Attribute\SerializedPath;

class GetAttachmentsResponse
{
  #[SerializedPath('[SOAP-ENV:Body][ns2:GetAttachmentsResponse][ns2:attachments]')]
  /**
   * The attachments.
   *
   * Meta information extracted from the WSDL
   *
   * - maxOccurs: unbounded
   * - minOccurs: 0
   *
   *
   * @var \Jawira\IrisboxSdk\DocumentModel\Attachment[]
   */
  public array $attachments = [];
}
