<?php

namespace Lukaswhite\Invoices\Tests;

use Lukaswhite\Invoices\Render\AddressRenderer;
use PHPUnit\Framework\TestCase;
use Lukaswhite\Invoices\Address;

class AddressRendererTest extends TestCase
{
    public function test_can_get_string_of_full_address()
    {
        $address = new Address();
        $address
            ->setLine1('123 Something Street')
            ->setLine2('Somewhere')
            ->setLine3('Or other')
            ->setCity('Somewhereville')
            ->setPostalCode('S0M WHR3');

        $renderer = new AddressRenderer($address);

        $this->assertEquals(
            "123 Something Street\nSomewhere\nOr other\nSomewhereville\nS0M WHR3",
            $renderer->render()
        );
    }

    public function test_can_get_string_of_address_without_all_fields()
    {
        $address = new Address();
        $address
            ->setLine1('123 Something Street')
            ->setCity('Somewhereville')
            ->setPostalCode('S0M WHR3');

        $renderer = new AddressRenderer($address);

        $this->assertEquals(
            "123 Something Street\nSomewhereville\nS0M WHR3",
            $renderer->render()
        );
    }

    public function test_can_get_html_of_full_address()
    {
        $address = new Address();
        $address
            ->setLine1('123 Something Street')
            ->setLine2('Somewhere')
            ->setLine3('Or other')
            ->setCity('Somewhereville')
            ->setPostalCode('S0M WHR3');

        $renderer = new AddressRenderer($address);

        $this->assertEquals(
            "123 Something Street\n<br/>\nSomewhere\n<br/>\nOr other\n<br/>\nSomewhereville\n<br/>\nS0M WHR3",
            $renderer->toHtml()
        );
    }
}