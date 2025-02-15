<?php declare(strict_types=1);

namespace Jawira\IrisboxSdk\DemandModel;

class GetDemandsBetweenDatesRequest
{
  public ?FormDetails $form = null;
  public ?string $startDate = null;
  public ?string $endDate = null;
  /**
   * The pages counter starts at '0' (0 = first page).
   */
  public ?int $pageNumber = null;
  /**
   * Set to 0 to get the latest version available.
   *
   * - minOccurs: 0
   * - nillable: true
   */
  public ?int $version = null;
}
