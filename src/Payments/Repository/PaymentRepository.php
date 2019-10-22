<?php
declare(strict_types=1);

namespace App\Payments\Repository;

use App\Payments\Model\Payment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Config\Definition\Exception\Exception;

class PaymentRepository extends ServiceEntityRepository implements PaymentRepositoryInterface
{

    private $manager;

    public function __construct(RegistryInterface $registry, ObjectManager $manager)
    {
        $this->manager = $manager;
        parent::__construct($registry, Payment::class);
    }

    /**
     * @return Payment[]
     */
    public function all(): array
    {
        $payments = parent::findAll();

        return $payments;
    }

    /**
     * @param int $id
     * @return object|null
     */
    public function one(int $id)
    {
        return parent::findOneBy(['id' => $id]);
    }

    /**
     * @param Payment $payment
     * @return Payment
     * @throws \Doctrine\ORM\ORMException
     */
    public function save(Payment $payment): Payment
    {
        /**
         * @var Payment $payment
         */
        $this->manager->persist($payment);
        $this->manager->flush();

        return $payment;
    }

    /**
     * @param Payment $payment
     * @return Payment
     * @throws \Doctrine\ORM\ORMException
     */
    public function update(Payment $payment): Payment
    {
        /**
         * @var Payment $payment
         */
        $this->manager->merge($payment);
        $this->manager->flush();

        return $payment;
    }

    /**
     * @param Payment $payment
     * @throws \Doctrine\ORM\ORMException
     */
    public function delete(Payment $payment): void
    {
        /**
         * @var Payment $payment;
         */
        $this->manager->remove($payment);
        $this->manager->flush();

    }
}