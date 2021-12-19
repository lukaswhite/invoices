<?php


namespace Lukaswhite\Invoices\Render;


use Lukaswhite\Invoices\Address;

/**
 * Class AddressRenderer
 *
 * Creates a string or HTML representation of an address. Essentially it just strips out any blank
 * fields; for example the second and/or third lines.
 *
 * @package Lukaswhite\Invoices\Render
 */
class AddressRenderer
{
    /**
     * @var Address
     */
    protected $address;

    /**
     * AddressRenderer constructor.
     * @param Address $address
     */
    public function __construct(Address $address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        return implode("\n", $this->getLines());
    }

    /**
     * @return string
     */
    public function toHtml(): string
    {
        return implode("\n<br/>\n", $this->getLines());
    }

    /**
     * Splits the address into an array of lines for rendering.
     *
     * @return array
     */
    protected function getLines(): array
    {
        $lines = [];
        if($this->address->getLine1()) {
            $lines[] = $this->address->getLine1();
        }
        if($this->address->getLine2()) {
            $lines[] = $this->address->getLine2();
        }
        if($this->address->getLine3()) {
            $lines[] = $this->address->getLine3();
        }
        if($this->address->getCity()) {
            $lines[] = $this->address->getCity();
        }
        if($this->address->getPostalCode()) {
            $lines[] = $this->address->getPostalCode();
        }
        return $lines;
    }
}