<?php declare(strict_types=1);

namespace Jawira\IrisboxSdk\DemandModel;

class GetDemandsByStatusResponse
{
  public ?int $currentPage = null;
  public ?int $totalPages = null;
  /**
   * The irisboxDemands.
   *
   * - maxOccurs: 10
   * - minOccurs: 0
   * - nillable: true
   */
  public ?array $irisboxDemands = null;
}
