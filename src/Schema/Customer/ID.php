<?php namespace Rem\BillingClient\Schema\Customer;

use Rem\BillingClient\Schema\Customer;

class ID extends Customer
{
    const TYPE = 'id';

    /**
     * @var string
     */
    protected $customerId;

    /**
     * @var string
     */
    protected $internalCustomerId;

    /**
     * @var string
     */
    protected $countryCode;

    public function __construct()
    {
        $this->setType(static::TYPE);
    }

    /**
     * @return string
     */
    public function getCustomerId()
    {
        return (string) $this->customerId ?: null;
    }

    /**
     * @param string $customerId
     *
     * @return $this
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;

        return $this;
    }

    /**
     * @return string
     */
    public function getInternalCustomerId()
    {
        return (string) $this->internalCustomerId ?: null;
    }

    /**
     * @param string $internalCustomerId
     *
     * @return $this
     */
    public function setInternalCustomerId($internalCustomerId)
    {
        $this->internalCustomerId = $internalCustomerId;

        return $this;
    }

    /**
     * @return string
     */
    public function getCountryCode()
    {
        return (string) $this->countryCode ?: null;
    }

    /**
     * @param string $countryCode
     *
     * @return $this
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'type' => $this->getType(),
            'customerId' => $this->getCustomerId(),
            'internalCustomerId' => $this->getInternalCustomerId(),
            'countryCode' => $this->getCountryCode(),
        ];
    }

    /**
     * @param array $data
     *
     * @return $this
     */
    public function fromArray(array $data)
    {
        $this->setCustomerId(isset($data['customerId']) ? $data['customerId'] : null);
        $this->setInternalCustomerId(isset($data['internalCustomerId']) ? $data['internalCustomerId'] : null);
        $this->setCountryCode(isset($data['countryCode']) ? $data['countryCode'] : null);

        return $this;
    }
}
