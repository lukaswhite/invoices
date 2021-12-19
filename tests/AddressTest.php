<?php

namespace Lukaswhite\Invoices\Tests;

use PHPUnit\Framework\TestCase;
use Lukaswhite\Invoices\Address;

class AddressTest extends TestCase
{
    public function test_can_set_and_get_elements()
    {
        $address = new Address();
        $address
            ->setLine1('123 Something Street')
            ->setLine2('Somewhere')
            ->setLine3('Or other')
            ->setCity('Somewhereville')
            ->setPostalCode('S0M WHR3');

        $this->assertEquals('123 Something Street', $address->getLine1());
        $this->assertEquals('Somewhere', $address->getLine2());
        $this->assertEquals('Or other', $address->getLine3());
        $this->assertEquals('Somewhereville', $address->getCity());
        $this->assertEquals('S0M WHR3', $address->getPostalCode());
    }
}