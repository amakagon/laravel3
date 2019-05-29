<?php namespace Rem\BillingClient\Schema\Customer;

use Rem\BillingClient\Schema\Customer;

class MySelf extends Customer
{
    const TYPE = 'self';

    public function __construct()
    {
        $this->setType(static::TYPE);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'type' => $this->getType(),
        ];
    }

    /**
     * @param array $data
     *
     * @return $this
     */
    public function fromArray(array $data)
    {
        return $this;
    }
}
