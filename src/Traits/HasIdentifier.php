<?php


namespace Lukaswhite\Invoices\Traits;

trait HasIdentifier
{
    /**
     * @var string
     */
    protected $identifier;

    /**
     * @param string $identifier
     * @return $this
     */
    public function identifiedBy(string $identifier): self
    {
        $this->identifier = $identifier;
        return $this;
    }

    /**
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }
}