# Invoices

A simple PHP library for building an invoice.

## Usage

```php
$invoice = new Invoice();

$invoice
    ->numbered('INV0001')
    ->totalling(100.5)
    ->inCurrency('GBP')
    ->setStatus('Overdue')
    ->issuedBy(
        (new Company('Acme'))
            ->setAddress(
                (new Address)
                    ->setLine1('123 Something Street')
                    ->setLine2('Somewhere')
                    ->setLine3('Or other')
                    ->setCity('Somewhereville')
                    ->setPostalCode('S0M WHR3')
                    ->setCountry('United Kingdom')
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
                    ->setCountry('United Kingdom')
            )
    )
    ->dated(new \DateTime('2021-12-07'))
    ->dueOn((new \DateTime('2021-12-07'))->add(new \DateInterval('P30D')))
    ->withNotes('Some notes');
```