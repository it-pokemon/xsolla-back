<?php
declare(strict_types=1);

namespace App\Payments\Model;
use Cassandra\Decimal;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * class Payment
 * @ORM\Entity(repositoryClass="App\Payments\Repository\PaymentRepository")
 */

class Payment
{
    const RUB = 1;
    const USD = 2;

    /**
     * @var int
     * @ORM\Id()
     * @ORM\Column(type="integer", length=11)
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @var int
     * @ORM\Column(type="integer", length=11);
     * @Assert\Type("integer")
     * @Assert\NotBlank
     * @Assert\NotNull
     * @Assert\Positive
     */
    private $orderNumber;

    /**
     * @var string;
     * @ORM\Column(type="decimal", precision=19, scale=2)
     */
    private $cost;

    /**
     * @var int;
     * @ORM\Column(type="integer", length=11)
     */
    private $currency;

    /**
     * @var string
     * @ORM\Column(type="string", length=19)
     */
    private $cardNumber;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $cardHolder;

    /**
     * @var int
     * @ORM\Column(type="integer", length=2)
     */
    private $expireMonth;

    /**
     * @var int
     * @ORM\Column(type="integer", length=2)
     */
    private $expireYear;

    /**
     * @var int
     * @ORM\Column(type="integer", length=3)
     */
    private $cardCvv;

    /**
     * Payment constructor.
     * @param int $orderNumber
     * @param string $cost
     * @param int $currency
     * @param string $cardNumber
     * @param string $cardHolder
     * @param int $expireMonth
     * @param int $expireYear
     * @param int $cardCvv
     */
    public function __construct(int $orderNumber, string $cost, int $currency, string $cardNumber,
                                string $cardHolder, int $expireMonth, int $expireYear, int $cardCvv)
    {
        $this->orderNumber = $orderNumber;
        $this->cost = $cost;
        $this->currency = $currency;
        $this->cardNumber = $cardNumber;
        $this->cardHolder = $cardHolder;
        $this->expireMonth = $expireMonth;
        $this->expireYear = $expireYear;
        $this->cardCvv = $cardCvv;
    }

    public function setRub() : void{
        $this->currency = self::RUB;
    }

    public  function setUSD() : void{
        $this->currency = self::USD;
    }

    /**
     * @return int
     */
    public function getOrderNumber(): int
    {
        return $this->orderNumber;
    }

    /**
     * @param int $orderNumber
     */
    public function setOrderNumber(int $orderNumber): void
    {
        $this->orderNumber = $orderNumber;
    }

    /**
     * @return string
     */
    public function getCost(): string
    {
        return $this->cost;
    }

    /**
     * @param string $cost
     */
    public function setCost(string $cost): void
    {
        $this->cost = $cost;
    }

    /**
     * @return int
     */
    public function getCurrency(): int
    {
        return $this->currency;
    }

    /**
     * @param int $currency
     */
    public function setCurrency(int $currency): void
    {
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getCardNumber(): string
    {
        return $this->cardNumber;
    }

    /**
     * @param string $cardNumber
     */
    public function setCardNumber(string $cardNumber): void
    {
        $this->cardNumber = $cardNumber;
    }

    /**
     * @return string
     */
    public function getCardHolder(): string
    {
        return $this->cardHolder;
    }

    /**
     * @param string $cardHolder
     */
    public function setCardHolder(string $cardHolder): void
    {
        $this->cardHolder = $cardHolder;
    }

    /**
     * @return int
     */
    public function getCardCvv(): int
    {
        return $this->cardCvv;
    }

    /**
     * @param int $cardCvv
     */
    public function setCardCvv(int $cardCvv): void
    {
        $this->cardCvv = $cardCvv;
    }

    /**
     * @return mixed
     */
    public function getExpireMonth()
    {
        return $this->expireMonth;
    }

    /**
     * @param mixed $expireMonth
     */
    public function setExpireMonth($expireMonth): void
    {
        $this->expireMonth = $expireMonth;
    }

    /**
     * @return mixed
     */
    public function getExpireYear()
    {
        return $this->expireYear;
    }

    /**
     * @param mixed $expireYear
     */
    public function setExpireYear($expireYear): void
    {
        $this->expireYear = $expireYear;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }


}