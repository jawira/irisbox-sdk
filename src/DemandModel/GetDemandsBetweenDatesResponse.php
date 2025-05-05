<?php declare(strict_types=1);

namespace Jawira\IrisboxSdk\DemandModel;

class GetDemandsBetweenDatesResponse
{
  public ?int $currentPage = null;
  public ?int $totalPages = null;
  /**
   * List of {@see Demand}.
   *
   * The list of {@see Demand} between two dates are returned in an array.
   * However, if there is only one {@see Demand}, this property will contain the {@see Demand} instead of an array.
   * Finally, if there are no {@see Demand}, this property will be null.
   *
   * - maxOccurs: 10
   * - minOccurs: 0
   * - nillable: true
   *
   * @return null|Demand|Demand[]
   */
  public null|Demand|array $irisboxDemands = [];
}
