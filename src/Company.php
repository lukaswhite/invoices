<?php


namespace Lukaswhite\Invoices;


use Lukaswhite\Invoices\Traits\HasCustomFields;
use Lukaswhite\Invoices\Traits\HasIdentifier;

class Company
{
    use     HasIdentifier
        ,   HasCustomFields;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var Address
     */
    protected $address;

    /**
     * Company constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * @param Address $address
     * @return Company
     */
    public function setAddress(Address $address): Company
    {
        $this->address = $address;
        return $this;
    }

}