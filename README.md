# IRISbox SDK

![Packagist Dependency Version](https://img.shields.io/packagist/dependency-v/jawira/irisbox-sdk/php)
![Packagist Version](https://img.shields.io/packagist/v/jawira/irisbox-sdk)
![Packagist License](https://img.shields.io/packagist/l/jawira/irisbox-sdk)
![Packagist Downloads](https://img.shields.io/packagist/dt/jawira/irisbox-sdk)

**This library provides two services to download data and files from [IRISbox e-admnistration](https://irisbox.irisnet.be/).** 

1. `\Jawira\IrisboxSdk\DemandService` 
   * `getDemandsBetweenDates()`
   * `getDemand()`
   * `getDemandsByStatus()`
   * `getFormXsd()`
   * `setDemandInternalReference()`
   * `setDemandStatus()`
2. `\Jawira\IrisboxSdk\DocumentService`
   * `getAttachments()` 
   * `getDemandPdf()` 
   * `setDemandStatusWithAttachments()` 

## Usage

```php
<?php

use Jawira\IrisboxSdk\DemandModel\FormDetails;
use Jawira\IrisboxSdk\DemandModel\GetDemandsBetweenDatesRequest;
use Jawira\IrisboxSdk\DemandService;

// Instantiate service
$demandService = new DemandService('my-username', 'my-password', DemandService::STAGING);

// Prepare DTOs
$form = new FormDetails();
$form->formName = 'MY_FORM';
$form->applicationName = 'MY_APPLICATION';
$request = new GetDemandsBetweenDatesRequest();
$request->form = $form;
$request->startDate = '2025-01-01';
$request->endDate = '2025-06-27';
$request->version = 0;
$request->pageNumber = 0;

// Send request
$response = $demandService->getDemandsBetweenDates($request);

// Print IDs from response
foreach ($response->irisboxDemands as $demand) {
  echo $demand->uniqueKey;
}
```

## How to install

```console
composer require jawira/irisbox-sdk
```

## Contributing

- Please report any bug.
- If you liked this project, ⭐ star it on GitHub. ![GitHub Repo stars](https://img.shields.io/github/stars/jawira/irisbox-sdk)
- Or follow me on 𝕏. [![Twitter Follow](https://img.shields.io/twitter/follow/jawira?style=social)](https://twitter.com/jawira)

## License

This library is licensed under the [MIT license](LICENSE.md).

***

## Packages from jawira

<dl>

<dt>
    <a href="https://packagist.org/packages/jawira/doctrine-diagram-bundle">jawira/doctrine-diagram-bundle
    <img alt="GitHub stars" src="https://badgen.net/github/stars/jawira/doctrine-diagram-bundle?icon=github"/></a>
</dt>
<dd>Symfony Bundle to generate database diagrams.</dd>

<dt><a href="https://packagist.org/packages/jawira/">more...</a></dt>
</dl>
