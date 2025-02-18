<?php declare(strict_types=1);

namespace Jawira\IrisboxSdk;

abstract class IrisboxService
{
  public function __construct(
    protected readonly string $username,
    protected readonly string $password,
    protected readonly string $wsdl,
  )
  {
  }
}
