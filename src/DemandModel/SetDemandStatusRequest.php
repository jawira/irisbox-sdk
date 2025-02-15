<?php declare(strict_types=1);

namespace Jawira\IrisboxClient\DemandModel;

class SetDemandStatusRequest
{
  public ?FormDetails $form = null;
  public ?string $demandUniqueKey = null;
  /**
   * Status must be one of these values:
   *
   * - AGENT_ACCEPTED
   * - AGENT_UNCOMPLETED
   * - AGENT_REFUSED
   * - AGENT_TOPAY
   * - RECEIVED
   */
  public ?string $status = null;
  /**
   * Message.
   *
   * - minOccurs: 0
   */
  public ?string $message = null;
  /**
   * Price.
   *
   * - minOccurs: 0
   */
  public ?float $price = null;
}
