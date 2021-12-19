<?php

namespace Lukaswhite\Invoices\Tests;

use PHPUnit\Framework\TestCase;
use Lukaswhite\Invoices\Item;

class ItemTest extends TestCase
{
    public function test_can_set_and_get_fields()
    {
        $item = new Item();
        $item
            ->withDescription('A product')
            ->identifiedBy('PROD001')
            ->forAmount(10.5)
            ->withQuantity(3);

        $this->assertEquals('A product', $item->getDescription());
        $this->assertEquals('PROD001', $item->getIdentifier());
        $this->assertEquals(10.5, $item->getAmount());
        $this->assertEquals(3, $item->getQuantity());
    }

    public function test_quantity_defaults_to_one()
    {
        $item = new Item();
        $this->assertEquals(1, $item->getQuantity());
    }

    public function test_can_calculate_line_total()
    {
        $item = new Item();
        $item
            ->withDescription('A product')
            ->forAmount(10.5)
            ->withQuantity(3);

        $this->assertEquals(31.5, $item->getTotal());
    }
}