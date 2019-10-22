<?php
declare(strict_types=1);

namespace App\Payments\Repository;

use App\Payments\Model\Payment;

interface PaymentRepositoryInterface
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
     * @param Payment $payment
     * @return Payment
     */
    public  function save(Payment $payment) : Payment;

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