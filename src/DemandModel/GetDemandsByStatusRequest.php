<?php declare(strict_types=1);

namespace Jawira\IrisboxSdk\DemandModel;

class GetDemandsByStatusRequest
{
  public ?FormDetails $form = null;
  public ?string $startDate = null;
  public ?string $endDate = null;

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
   * The pages counter starts at '0' (0 = first page).
   */
  public int $pageNumber = 0;
  /**
   * Set to 0 to get the latest version available.
   *
   * - minOccurs: 0
   * - nillable: true
   */
  public int $version = 0;
}
