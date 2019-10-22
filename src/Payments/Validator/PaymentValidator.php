<?php


namespace App\Payments\Validator;


class PaymentValidator implements PaymentValidatorInterface
{

    /**
     * @param array $dataPaymentForm
     * @return array
     */
    public function PaymentValidator(array $dataPaymentForm): array
    {
        $errors = array();

        foreach($dataPaymentForm as $key => $value) {
            switch ($key) {
                case "orderNumber" :
                    if (!$this->isOrderNumberValid($value)) {
                        $errors[$key] = "Номер заказа не должен быть пустым и должен состоять из цифр.";
                    }
                    $dataPaymentForm[$key] = (int) $value;
                    break;
                case "cost" :
                    if (!$this->isCostValid($value)) {
                        $errors[$key] = "Стоимость заказа не долежна быть пустой или отрицательной.";
                    }
                    $dataPaymentForm[$key] = $value;
                    break;
                case "currency" :
                    if (!$this->isCurrencyValid($value)) {
                        $errors[$key] = "Валюта не должна быть пустой.";
                    }
                    $dataPaymentForm[$key] = (int) $value;
                    break;
                case "cardNumber" :
                    if (!$this->isCardNumberValid($value)) {
                        $errors[$key] = "Номер карты не должен быть пустым и должен состоять из 16 цифр.";
                    }
                    break;
                case "expireMonth" :
                    if (!$this->isExpireMonthValid($value)) {
                        $errors[$key] = "Месяц окончания действия карты указан не корректно.";
                    }
                    $dataPaymentForm[$key] = (int) $value;
                    break;
                case "expireYear" :
                    if (!$this->isExpireYearValid($value)) {
                        $errors[$key] = "Год окончания действия карты указан не корректно.";
                    }
                    $dataPaymentForm[$key] = (int) $value;
                    break;
                case "cardCvv" :
                    if (!$this->isCardCvvValid($value)) {
                        $errors[$key] = "Номер Cvv не должен быть пустым и должен состоять из 3 цифр.";
                    }
                    $dataPaymentForm[$key] = (int) $value;
                    break;
            }
        }

        return $dataPaymentForm = array (
            'errors' => $errors,
            'data' => $dataPaymentForm
        );
    }

    /**
     * @param string $orderNumber
     * @return bool
     */
    public function isOrderNumberValid(string $orderNumber): bool
    {
        return !is_null($orderNumber) && !empty($orderNumber) && (int)$orderNumber != 0;
    }

    /**
     * @param string $cost
     * @return bool
     */
    public function isCostValid(string $cost): bool
    {
        $cost = (float) $cost;
        return !is_null($cost) && !empty($cost) && is_float($cost) && $cost > 0;
    }

    /**
     * @param string $cardNumber
     * @return bool
     */
    public function isCardNumberValid(string $cardNumber): bool
    {
        return !is_null($cardNumber) && !empty($cardNumber) && strlen($cardNumber) == 16;
    }

    /**
     * @param string $cardCvv
     * @return bool
     */
    public function isCardCvvValid(string $cardCvv): bool
    {
        return !is_null($cardCvv) && !empty($cardCvv) && strlen($cardCvv) == 3;
    }

    /**
     * @param string $expireMonth
     * @return bool
     */
    public function isExpireMonthValid(string $expireMonth): bool
    {
        $expireMonth = (int) $expireMonth;
        return !is_null($expireMonth) && !empty($expireMonth) && $expireMonth >= 1 && $expireMonth <= 12;
    }

    /**
     * @param string $expireYear
     * @return bool
     */
    public function isExpireYearValid(string $expireYear): bool
    {
        return !is_null($expireYear) && !empty($expireYear) && $expireYear >= date('y');
    }

    /**
     * @param string $currency
     * @return bool
     */
    public function isCurrencyValid(string $currency): bool
    {
        $currency = (int) $currency;
        return !is_null($currency) && !empty($currency);
    }
}