<?php declare(strict_types=1);

namespace Jawira\IrisboxClient\DemandModel;

class SetDemandInternalReferenceRequest
{
  public ?FormDetails $form = null;
  public ?string $demandUniqueKey = null;
  public ?string $internalReference = null;
}
