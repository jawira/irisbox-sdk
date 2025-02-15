<?php declare(strict_types=1);

namespace Jawira\IrisboxClient\DemandModel;

class GetFormXSDRequest
{
  public ?FormDetails $form = null;
  /**
   * Set to 0 to get the latest version available.
   */
  public ?int $version = null;
}
