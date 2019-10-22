<?php
declare(strict_types=1);

namespace App\Payments\Service;

use App\Payments\Model\Payment;


interface PaymentServiceInterface
{
    /**
     * @return Payment[]
     */
    public function all() : array;

    /**
     * @param int $id
     * @return object|null
     */
    public function one(int $id);

    /**
     * @param int $orderNumber
     * @param string $cost
     * @param int $currency
     * @param string $cardNumber
     * @param string $cardHolder
     * @param int $expireMonth
     * @param int $expireYear
     * @param int $cardCvv
     * @return Payment
     */
    public function create(int $orderNumber, string $cost, int $currency, string $cardNumber,
                           string $cardHolder, int $expireMonth, int $expireYear, int $cardCvv) : Payment;

    /**
     * @param Payment $payment
     * @return Payment
     */
    public function update(Payment $payment) : Payment;

    /**
     * @param Payment $payment
     */
    public function delete(Payment $payment) : void;
}