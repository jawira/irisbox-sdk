<?php declare(strict_types=1);

namespace Jawira\IrisboxClient\DemandModel;

class Demand
{
  public ?string $uniqueKey = null;
  public ?string $reference = null;
  /**
   * Internal reference.
   *
   * - minOccurs: 0
   *
   * @var string|null
   */
  public ?string $internalReference = null;
  public ?string $status = null;
  public ?string $sentDate = null;
  public ?string $userRequester = null;
  /**
   * The enterprise
   *
   * Meta information extracted from the WSDL
   *
   * - minOccurs: 0
   */
  public ?string $enterprise = null;
  public ?float $price = null;
  /**
   * The ogoneReference
   *
   * Meta information extracted from the WSDL
   *
   * - minOccurs: 0
   */
  public ?int $ogoneReference = null;
  /**
   * The ogoneOrderId
   *
   * Meta information extracted from the WSDL
   *
   * - minOccurs: 0
   */
  public ?string $ogoneOrderId = null;
  /**
   * The ogoneAlias
   *
   * Meta information extracted from the WSDL
   *
   * - minOccurs: 0
   */
  public ?string $ogoneAlias = null;
  /**
   * The isPaid
   *
   * Meta information extracted from the WSDL
   *
   * - minOccurs: 0
   */
  public ?bool $isPaid = null;
  /**
   * The formXml.
   *
   * Meta information extracted from the WSDL
   *
   * - nillable: true
   */
  public ?string $formXml = null;
}
