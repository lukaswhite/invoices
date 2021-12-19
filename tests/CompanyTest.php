<?php

namespace Lukaswhite\Invoices\Tests;

use PHPUnit\Framework\TestCase;
use Lukaswhite\Invoices\Company;
use Lukaswhite\Invoices\Address;

class CompanyTest extends TestCase
{
    public function test_can_set_and_get_fields()
    {
        $company = new Company('Acme');
        $company->identifiedBy('ACME0001');

        $address = new Address();
        $address
            ->setLine1('123 Something Street')
            ->setLine2('Somewhere')
            ->setLine3('Or other')
            ->setCity('Somewhereville')
            ->setPostalCode('S0M WHR3');

        $company->setAddress($address);

        $this->assertEquals('Acme', $company->getName());
        $this->assertEquals('ACME0001', $company->getIdentifier());
        $this->assertEquals('S0M WHR3', $company->getAddress()->getPostalCode());
    }

    public function test_can_add_custom_fields()
    {
        $company = new Company('Acme');
        $company->addCustomField('email', 'enquries@acme.org', 3);
        $company->addCustomField('website', 'www.acme.org', 5);

        $this->assertEquals([
            'website'   =>  'www.acme.org',
            'email'     =>  'enquries@acme.org',
        ], $company->getCustomFields());
    }
}