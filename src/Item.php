<?php


namespace Lukaswhite\Invoices;


use Lukaswhite\Invoices\Traits\HasIdentifier;

class Item
{
    use HasIdentifier;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var int
     */
    protected $quantity = 1;

    /**
     * @var float
     */
    protected $amount;

    /**
     * @param string $description
     * @return $this
     */
    public function withDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param float $amount
     * @return $this
     */
    public function forAmount(float $amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @param int $quantity
     * @return $this
     */
    public function withQuantity(int $quantity): self
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return float
     */
    public function getTotal(): float
    {
        return $this->quantity * $this->amount;
    }


}