<?php declare(strict_types=1);

namespace Jawira\IrisboxSdk\Soap;

interface SoapClientInterface
{
  public function setCredentials(string $username, string $password): void;
}
