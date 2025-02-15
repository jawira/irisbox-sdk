<?php

namespace Jawira\IrisboxClientTests;

use Jawira\IrisboxClient\DemandModel\FormDetails;
use Jawira\IrisboxClient\DemandService;
use PHPUnit\Framework\TestCase;

abstract class IrisboxCase extends TestCase
{
  protected static DemandService $demandService;

  public static function setUpBeforeClass(): void
  {
    $username = getenv('IRISBOX_USERNAME');
    $password = getenv('IRISBOX_PASSWORD');
    $wsdl = DemandService::STAGING;
    DemandTest::$demandService = new DemandService($username, $password, $wsdl);
  }

  protected function generateFormDetails(): FormDetails
  {
    $form = new FormDetails();
    $form->formName = getenv('IRISBOX_FORM_NAME');
    $form->applicationName = getenv('IRISBOX_APPLICATION_NAME');
    return $form;
  }
}
