<?php


namespace Lukaswhite\Invoices\Traits;

trait HasCustomFields
{
    /**
     * @var array
     */
    protected $customFields = [];

    /**
     * @param string $name
     * @param mixed $value
     * @param int $weight
     * @return $this
     */
    public function addCustomField(string $name, mixed $value, int $weight = 1)
    {
        $this->customFields[$name] = [
            'value'     =>  $value,
            'weight'    =>  $weight,
        ];

        uasort($this->customFields, function(array $a, array $b){
            return $b['weight'] - $a['weight'];
        });

        return $this;
    }

    /**
     * @return array
     */
    public function getCustomFields(): array
    {
        return array_map(
            function(array $field){
                return $field['value'];
            },
            $this->customFields
        );
    }
}