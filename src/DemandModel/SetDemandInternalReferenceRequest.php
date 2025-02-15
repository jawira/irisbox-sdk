<?php declare(strict_types=1);

namespace Jawira\IrisboxSdk\DemandModel;

class SetDemandInternalReferenceRequest
{
  public ?FormDetails $form = null;
  public ?string $demandUniqueKey = null;
  public ?string $internalReference = null;
}
