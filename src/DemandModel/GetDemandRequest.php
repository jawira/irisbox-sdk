<?php declare(strict_types=1);

namespace Jawira\IrisboxClient\DemandModel;

class GetDemandRequest
{
  public ?FormDetails $form = null;
  public ?string $demandUniqueKey = null;
}
