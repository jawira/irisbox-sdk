<?php declare(strict_types=1);

namespace Jawira\IrisboxSdk\DocumentModel;

class GetDemandPDFRequest
{
  public ?FormDetails $form = null;
  public ?string $demandUniqueKey = null;
}
