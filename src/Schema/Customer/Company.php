<?php namespace Rem\BillingClient\Schema\Customer;

use Rem\BillingClient\Schema\Customer;

class Company extends Customer
{
    const TYPE = 'company';

    /**
     * @var string
     */
    protected $customerId;

    /**
     * @var string
     */
    protected $company;

    /**
     * @var string
     */
    protected $countryCode;

    /**
     * @var string
     */
    protected $regionCode;

    /**
     * @var string
     */
    protected $telephone;

    /**
     * @var string
     */
    protected $vatId;

    /**
     * @var string
     */
    protected $city;

    /**
     * @var string
     */
    protected $road;

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
    public function getCompany()
    {
        return (string) $this->company ?: null;
    }

    /**
     * @param string $company
     *
     * @return $this
     */
    public function setCompany($company)
    {
        $this->company = $company;

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
     * @return string
     */
    public function getRegionCode()
    {
        return (string) $this->regionCode ?: null;
    }

    /**
     * @param string $regionCode
     *
     * @return $this
     */
    public function setRegionCode($regionCode)
    {
        $this->regionCode = $regionCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getTelephone()
    {
        return (string) $this->telephone ?: null;
    }

    /**
     * @param string $telephone
     *
     * @return $this
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * @return string
     */
    public function getVatId()
    {
        return (string) $this->vatId ?: null;
    }

    /**
     * @param string $vatId
     *
     * @return $this
     */
    public function setVatId($vatId)
    {
        $this->vatId = $vatId;

        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return (string) $this->city ?: null;
    }

    /**
     * @param string $city
     *
     * @return $this
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string
     */
    public function getRoad()
    {
        return (string) $this->road ?: null;
    }

    /**
     * @param string $road
     *
     * @return $this
     */
    public function setRoad($road)
    {
        $this->road = $road;

        return $this;
    }

    /**
     * @var array
     */
    public function toArray()
    {
        return [
            'type' => $this->getType(),
            'customerId' => $this->getCustomerId(),
            'company' => $this->getCompany(),
            'countryCode' => $this->getCountryCode(),
            'regionCode' => $this->getRegionCode(),
            'telephone' => $this->getTelephone(),
            'vatId' => $this->getVatId(),
            'city' => $this->getCity(),
            'road' => $this->getRoad(),
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
        $this->setCompany(isset($data['company']) ? $data['company'] : null);
        $this->setCountryCode(isset($data['countryCode']) ? $data['countryCode'] : null);
        $this->setRegionCode(isset($data['regionCode']) ? $data['regionCode'] : null);
        $this->setTelephone(isset($data['telephone']) ? $data['telephone'] : null);
        $this->setVatId(isset($data['vatId']) ? $data['vatId'] : null);
        $this->setCity(isset($data['city']) ? $data['city'] : null);
        $this->setRoad(isset($data['road']) ? $data['road'] : null);

        return $this;
    }
}
