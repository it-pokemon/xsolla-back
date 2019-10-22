<?php
declare(strict_types=1);

namespace App\Payments\Service;

use App\Payments\Model\Payment;
use App\Payments\Repository\PaymentRepositoryInterface;

class PaymentService implements PaymentServiceInterface
{
    private $repository;

    public function __construct(PaymentRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return Payment[]
     */
    public function all() : array
    {
        return $this->repository->all();
    }

    /**
     * @param int $id
     * @return object|null
     */
    public function one(int $id)
    {
        return $this->repository->one($id);
    }

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
    public function create(int $orderNumber, string $cost, int $currency, string $cardNumber, string $cardHolder, int $expireMonth, int $expireYear, int $cardCvv): Payment
    {
        $payment = new Payment($orderNumber, $cost, $currency, $cardNumber, $cardHolder, $expireMonth, $expireYear, $cardCvv);
        $payment = $this->repository->save($payment);

        return $payment;
    }

    /**
     * @param Payment $payment
     * @return Payment
     */
    public function update(Payment $payment): Payment
    {
        $payment = $this->repository->update($payment);

        return $payment;
    }

    /**
     * @param Payment $payment
     */
    public function delete(Payment $payment): void
    {
        $payment = $this->repository->delete($payment);
    }
}