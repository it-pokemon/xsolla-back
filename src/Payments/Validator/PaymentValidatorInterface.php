<?php
namespace App\Payments\Validator;

interface PaymentValidatorInterface
{
    /**
     * @param array $dataPaymentForm
     * @return array
     */
    public function PaymentValidator(array $dataPaymentForm): array;

    /**
     * @param string $orderNumber
     * @return bool
     */
    public function isOrderNumberValid(string $orderNumber) : bool;

    /**
     * @param string $cost
     * @return bool
     */
    public function isCostValid(string $cost) : bool;

    /**
     * @param string $currency
     * @return bool
     */
    public function isCurrencyValid(string $currency) : bool;

    /**
     * @param string $cardNumber
     * @return bool
     */
    public function isCardNumberValid(string $cardNumber) : bool;

    /**
     * @param string $expireMonth
     * @return bool
     */
    public function isExpireMonthValid(string $expireMonth) : bool;

    /**
     * @param string $expireYear
     * @return bool
     */
    public function isExpireYearValid(string $expireYear) : bool;

    /**
     * @param string $cardCvv
     * @return bool
     */
    public function isCardCvvValid(string $cardCvv) : bool;
}