<?php


namespace Lukaswhite\Invoices;


use Lukaswhite\Invoices\Traits\HasCustomFields;

/**
 * Class Invoice
 *
 * An object-oriented representation of an invoice, with a fluent interface.
 *
 * @package Lukaswhite\Invoices
 */
class Invoice
{
    use HasCustomFields;

    /**
     * @var string
     */
    protected $number;

    /**
     * @var float
     */
    protected $total;

    /**
     * @var \DateTime
     */
    protected $date;

    /**
     * @var \DateTime
     */
    protected $dueDate;

    /**
     * @var string
     */
    protected $currency;

    /**
     * @var Company
     */
    protected $company;

    /**
     * @var Company
     */
    protected $customer;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var string
     */
    protected $notes;

    /**
     * @var float
     */
    protected $discountAmount;

    /**
     * @var int
     */
    protected $discountPercentage;

    /**
     * @var float
     */
    protected $shipping;

    /**
     * @var array
     */
    protected $items = [];

    /**
     * Invoice constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->date = new \DateTime('now');
    }

    /**
     * @param string $number
     * @return $this
     */
    public function numbered(string $number): self
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @param \DateTime $date
     * @return $this
     */
    public function dated(\DateTime $date): self
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @param \DateTime $date
     * @return $this
     */
    public function dueOn(\DateTime $date): self
    {
        $this->dueDate = $date;
        return $this;
    }

    /**
     * @param int $days
     * @return $this
     * @throws \Exception
     */
    public function dueInDays(int $days): self
    {
        $date = clone $this->date;
        return $this->dueOn($date->add(new \DateInterval(sprintf('P%dD', $days))));
    }

    /**
     * @param float $amount
     * @return $this
     */
    public function totalling(float $amount): self
    {
        $this->total = $amount;
        return $this;
    }

    /**
     * @param string $currency
     * @return $this
     */
    public function inCurrency(string $currency): self
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @param Company $company
     * @return $this
     */
    public function issuedTo(Company $company): self
    {
        $this->customer = $company;
        return $this;
    }

    /**
     * @param Company $company
     * @return $this
     */
    public function issuedBy(Company $company): self
    {
        $this->company = $company;
        return $this;
    }

    /**
     * @param string $status
     * @return $this
     */
    public function withStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @param string $notes
     * @return $this
     */
    public function withNotes(string $notes): self
    {
        $this->notes = $notes;
        return $this;
    }

    /**
     * Set a discount as an (monetary) amount, which will get deducted from the sub-total.
     *
     * @param float $amount
     * @return $this
     */
    public function discountedByAmount(float $amount): self
    {
        $this->discountAmount = $amount;
        return $this;
    }

    /**
     * Set a discount as a percentage.
     *
     * @param int $percentage
     * @return $this
     */
    public function discountedByPercentage(int $percentage): self
    {
        $this->discountPercentage = $percentage;
        return $this;
    }

    /**
     * @param float $amount
     * @return $this
     */
    public function withShippingCost(float $amount): self
    {
        $this->shipping = $amount;
        return $this;
    }

    /**
     * @param Item $item
     * @return $this
     */
    public function addItem(Item $item): self
    {
        $this->items[] = $item;
        return $this;
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @return float
     */
    public function getTotal(): float
    {
        return $this->total;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @return \DateTime
     */
    public function getDueDate(): \DateTime
    {
        return $this->dueDate;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return Company
     */
    public function getCompany(): Company
    {
        return $this->company;
    }

    /**
     * @return Company
     */
    public function getCustomer(): Company
    {
        return $this->customer;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getNotes(): ?string
    {
        return $this->notes;
    }

    /**
     * @return float
     */
    public function getDiscountAmount(): float
    {
        return $this->discountAmount;
    }

    /**
     * @return int
     */
    public function getDiscountPercentage(): int
    {
        return $this->discountPercentage;
    }

    /**
     * @return bool
     */
    public function hasDiscount(): bool
    {
        return !empty($this->discountAmount) || !empty($this->discountPercentage);
    }

    /**
     * @return float
     */
    public function getShipping(): float
    {
        return $this->shipping;
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

}