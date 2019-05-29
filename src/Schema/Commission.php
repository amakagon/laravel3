<?php namespace Rem\BillingClient\Schema;

class Commission extends Charge
{
    const CODE_PROVISION_AUCTION = 'provision_auction';
    const CODE_PROVISION_AUCTION_RENEW = 'provision_auction_renew';
    const CODE_PROVISION_PRICE_UPDATE = 'provision_price_update';

    /**
     * @var string
     */
    protected $baseCurrencyCode;

    /**
     * @var string
     */
    protected $currencyCode;

    /**
     * @var float
     */
    protected $exchangeRate;

    /**
     * @var string
     */
    protected $auctionId;

    /**
     * @var string
     */
    protected $commissionId;

    /**
     * @var string
     */
    protected $service;

    /**
     * @var string
     */
    protected $paidAt;

    /**
     * @var Customer
     */
    protected $customer;

    /**
     * @var int
     */
    protected $quantity;

    /**
     * @return int
     */
    public function getQuantity()
    {
        return (int) $this->quantity ?: null;
    }

    /**
     * @param int $quantity
     *
     * @return $this
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return string
     */
    public function getBaseCurrencyCode()
    {
        return (string) $this->baseCurrencyCode ?: null;
    }

    /**
     * @param string $baseCurrencyCode
     *
     * @return $this
     */
    public function setBaseCurrencyCode($baseCurrencyCode)
    {
        $this->baseCurrencyCode = $baseCurrencyCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getCurrencyCode()
    {
        return (string) $this->currencyCode ?: null;
    }

    /**
     * @param string $currencyCode
     *
     * @return $this
     */
    public function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;

        return $this;
    }

    /**
     * @return float
     */
    public function getExchangeRate()
    {
        return (float) $this->exchangeRate ?: null;
    }

    /**
     * @param float $exchangeRate
     *
     * @return $this
     */
    public function setExchangeRate($exchangeRate)
    {
        $this->exchangeRate = $exchangeRate;

        return $this;
    }

    /**
     * @return string
     */
    public function getAuctionId()
    {
        return (string) $this->auctionId ?: null;
    }

    /**
     * @param string $auctionId
     *
     * @return $this
     */
    public function setAuctionId($auctionId)
    {
        $this->auctionId = $auctionId;

        return $this;
    }

    /**
     * @return string
     */
    public function getCommissionId()
    {
        return (string) $this->commissionId ?: null;
    }

    /**
     * @param string $commissionId
     *
     * @return $this
     */
    public function setCommissionId($commissionId)
    {
        $this->commissionId = $commissionId;

        return $this;
    }

    /**
     * @return string
     */
    public function getService()
    {
        return (string) $this->service ?: null;
    }

    /**
     * @param string $service
     *
     * @return $this
     */
    public function setService($service)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * @return string
     */
    public function getPaidAt()
    {
        return (string) $this->paidAt ?: null;
    }

    /**
     * @param string $paidAt
     *
     * @return $this
     */
    public function setPaidAt($paidAt)
    {
        $this->paidAt = $paidAt;

        return $this;
    }

    /**
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param Customer $customer
     *
     * @return $this
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $customer = null;

        if (null !== $this->getCustomer()) {
            $customer = $this->getCustomer()->toArray();
        }

        return [
            'service' => $this->getService(),
            'code' => $this->getCode(),
            'paidAt' => $this->getPaidAt(),
            'baseCurrencyCode' => $this->getBaseCurrencyCode(),
            'currencyCode' => $this->getCurrencyCode(),
            'exchangeRate' => $this->getExchangeRate(),
            'basePrice' => $this->getBasePrice(),
            'price' => $this->getPrice(),
            'auctionId' => $this->getAuctionId(),
            'commissionId' => $this->getCommissionId(),
            'customer' => $customer,
            'quantity' => $this->getQuantity(),
        ];
    }

    /**
     * @param array $data
     *
     * @return $this
     */
    public function fromArray(array $data)
    {
        $this->setService(isset($data['service']) ? $data['service'] : null);
        $this->setCode(isset($data['code']) ? $data['code'] : null);
        $this->setPaidAt(isset($data['paidAt']) ? $data['paidAt'] : null);
        $this->setBaseCurrencyCode(isset($data['baseCurrencyCode']) ? $data['baseCurrencyCode'] : null);
        $this->setCurrencyCode(isset($data['currencyCode']) ? $data['currencyCode'] : null);
        $this->setExchangeRate(isset($data['exchangeRate']) ? $data['exchangeRate'] : null);
        $this->setBasePrice(isset($data['basePrice']) ? $data['basePrice'] : null);
        $this->setPrice(isset($data['price']) ? $data['price'] : null);
        $this->setAuctionId(isset($data['auctionId']) ? $data['auctionId'] : null);
        $this->setCommissionId(isset($data['commissionId']) ? $data['commissionId'] : null);
        $this->setQuantity(isset($data['quantity']) ? $data['quantity'] : null);

        if (isset($data['customer']['type'])) {
            $customer = Customer::getModelBasedOnType($data['customer']['type']);
            $customer->fromArray($data['customer']);
            $this->setCustomer($customer);
        }

        return $this;
    }
}
