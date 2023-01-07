<?php
/*
 * MundiAPILib
 *
 * This file was automatically generated by APIMATIC v2.0 ( https://apimatic.io ).
 */

namespace MundiAPILib\Models;

use JsonSerializable;
use MundiAPILib\Utils\DateTimeHelper;

/**
 *Contains the settings for creating a boleto payment
 */
class CreateBoletoPaymentRequest implements JsonSerializable
{
    /**
     * Number of retries
     * @required
     * @var integer $retries public property
     */
    public $retries;

    /**
     * The bank code, containing three characters. The available codes are on the API specification
     * @required
     * @var string $bank public property
     */
    public $bank;

    /**
     * The instructions field that will be printed on the boleto.
     * @required
     * @var string $instructions public property
     */
    public $instructions;

    /**
     * Boleto due date
     * @maps due_at
     * @factory \MundiAPILib\Utils\DateTimeHelper::fromRfc3339DateTime
     * @var \DateTime|null $dueAt public property
     */
    public $dueAt;

    /**
     * Card's billing address
     * @required
     * @maps billing_address
     * @var \MundiAPILib\Models\CreateAddressRequest $billingAddress public property
     */
    public $billingAddress;

    /**
     * The address id for the billing address
     * @required
     * @maps billing_address_id
     * @var string $billingAddressId public property
     */
    public $billingAddressId;

    /**
     * Customer identification number with the bank
     * @maps nosso_numero
     * @var string|null $nossoNumero public property
     */
    public $nossoNumero;

    /**
     * Boleto identification
     * @required
     * @maps document_number
     * @var string $documentNumber public property
     */
    public $documentNumber;

    /**
     * Constructor to set initial or default values of member properties
     * @param integer               $retries          Initialization value for $this->retries
     * @param string                $bank             Initialization value for $this->bank
     * @param string                $instructions     Initialization value for $this->instructions
     * @param \DateTime             $dueAt            Initialization value for $this->dueAt
     * @param CreateAddressRequest  $billingAddress   Initialization value for $this->billingAddress
     * @param string                $billingAddressId Initialization value for $this->billingAddressId
     * @param string                $nossoNumero      Initialization value for $this->nossoNumero
     * @param string                $documentNumber   Initialization value for $this->documentNumber
     */
    public function __construct()
    {
        if (8 == func_num_args()) {
            $this->retries          = func_get_arg(0);
            $this->bank             = func_get_arg(1);
            $this->instructions     = func_get_arg(2);
            $this->dueAt            = func_get_arg(3);
            $this->billingAddress   = func_get_arg(4);
            $this->billingAddressId = func_get_arg(5);
            $this->nossoNumero      = func_get_arg(6);
            $this->documentNumber   = func_get_arg(7);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['retries']            = $this->retries;
        $json['bank']               = $this->bank;
        $json['instructions']       = $this->instructions;
        $json['due_at']             = isset($this->dueAt) ?
            DateTimeHelper::toRfc3339DateTime($this->dueAt) : null;
        $json['billing_address']    = $this->billingAddress;
        $json['billing_address_id'] = $this->billingAddressId;
        $json['nosso_numero']       = $this->nossoNumero;
        $json['document_number']    = $this->documentNumber;

        return $json;
    }
}
