<?php

namespace Lukaswhite\Invoices\Tests;

use PHPUnit\Framework\TestCase;
use Lukaswhite\Invoices\Invoice;
use Lukaswhite\Invoices\Item;
use Lukaswhite\Invoices\Company;
use Lukaswhite\Invoices\Address;

class InvoiceTest extends TestCase
{
    public function test_can_set_and_get_fields()
    {
        $invoice = new Invoice();

        $invoice
            ->numbered('INV0001')
            ->totalling(100.5)
            ->inCurrency('GBP')
            ->withStatus('Paid')
            ->issuedBy(
                (new Company('Acme'))
                    ->setAddress(
                        (new Address)
                            ->setLine1('123 Something Street')
                            ->setLine2('Somewhere')
                            ->setLine3('Or other')
                            ->setCity('Somewhereville')
                            ->setPostalCode('S0M WHR3')
                    )
            )
            ->issuedTo(
                (new Company('Customer Inc.'))
                    ->setAddress(
                        (new Address)
                            ->setLine1('321 Something Street')
                            ->setLine2('Somewhere')
                            ->setLine3('Or other')
                            ->setCity('Somewhereville')
                            ->setPostalCode('S0M WHR3')
                    )
            )
            ->dated(new \DateTime('2021-12-07'))
            ->dueOn((new \DateTime('2021-12-07'))->add(new \DateInterval('P30D')))
            ->withNotes('Some notes');

        $item1 = new Item();
        $item1
            ->withDescription('A product')
            ->forAmount(10.5)
            ->withQuantity(3);

        $item2 = new Item();
        $item2
            ->withDescription('Another product')
            ->forAmount(7.5)
            ->withQuantity(2);

        $invoice
            ->addItem($item1)
            ->addItem($item2);

        $this->assertEquals('INV0001', $invoice->getNumber());
        $this->assertEquals(100.5, $invoice->getTotal());
        $this->assertEquals('GBP', $invoice->getCurrency());
        $this->assertEquals('Paid', $invoice->getStatus());
        $this->assertEquals('Acme', $invoice->getCompany()->getName());
        $this->assertEquals('Customer Inc.', $invoice->getCustomer()->getName());
        $this->assertEquals('2021-12-07', date_format($invoice->getDate(), 'Y-m-d'));
        $this->assertEquals('2022-01-06', date_format($invoice->getDueDate(), 'Y-m-d'));
        $this->assertEquals('Some notes', $invoice->getNotes());
        $this->assertEquals(2, count($invoice->getItems()));
    }

    public function test_defaults_to_today()
    {
        $invoice = new Invoice();
        $this->assertNotNull($invoice->getDate());
        $this->assertEquals(
            date_format(new \DateTime('now'), 'Y-m-d'),
            date_format($invoice->getDate(), 'Y-m-d')
        );
    }

    public function test_can_set_due_date_in_days()
    {
        $invoice = new Invoice();
        $invoice
            ->dated(new \DateTime('2021-12-07'))
            ->dueInDays(30);

        $this->assertEquals('2021-12-07', date_format($invoice->getDate(), 'Y-m-d'));
        $this->assertEquals('2022-01-06', date_format($invoice->getDueDate(), 'Y-m-d'));
    }

    public function test_can_have_custom_fields()
    {
        $invoice = new Invoice();
        $invoice->addCustomField('terms', 'Payable within 14 days');
        $this->assertEquals(['terms' => 'Payable within 14 days'], $invoice->getCustomFields());
    }

    public function test_can_discount_by_amount()
    {
        $invoice = new Invoice();
        $invoice->discountedByAmount(100);
        $this->assertTrue($invoice->hasDiscount());
        $this->assertEquals(100, $invoice->getDiscountAmount());
    }

    public function test_can_discount_by_percentage()
    {
        $invoice = new Invoice();
        $invoice->discountedByPercentage(50);
        $this->assertTrue($invoice->hasDiscount());
        $this->assertEquals(50, $invoice->getDiscountPercentage());
    }

    public function test_can_add_shipping_costs()
    {
        $invoice = new Invoice();
        $invoice->withShippingCost(2.95);
        $this->assertEquals(2.95, $invoice->getShipping());
    }

}