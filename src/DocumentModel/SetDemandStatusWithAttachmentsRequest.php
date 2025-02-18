<?php declare(strict_types=1);

namespace Jawira\IrisboxSdk\DocumentModel;

class SetDemandStatusWithAttachmentsRequest
{
  public ?FormDetails $form = null;
  public ?string $demandUniqueKey = null;

  /**
   * Must be one of:
   *
   * - AGENT_IN_TREATMENT
   * - AGENT_ACCEPTED
   * - AGENT_UNCOMPLETED
   * - AGENT_REFUSED
   * - AGENT_TOPAY
   * - RECEIVED
   */
  public ?string $status = null;
  /**
   * The message.
   *
   * Meta information extracted from the WSDL
   *
   * - minOccurs: 0
   */
  public ?string $message = null;
  /**
   * The price
   *
   * Meta information extracted from the WSDL
   *
   * - minOccurs: 0
   */
  public ?float $price = null;
  /**
   * The attachments
   *
   * Meta information extracted from the WSDL
   *
   * - maxOccurs: 4
   * - minOccurs: 0
   */
  public ?array $attachments = null;
}
