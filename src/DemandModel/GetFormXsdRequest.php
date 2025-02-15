<?php declare(strict_types=1);

namespace Jawira\IrisboxSdk\DemandModel;

class GetFormXsdRequest
{
  public ?FormDetails $form = null;
  /**
   * Set to 0 to get the latest version available.
   */
  public ?int $version = null;
}
