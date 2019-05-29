<?php namespace Rem\BillingClient\Schema;

class Refund
{
    /**
     * @var string
     */
    protected $service;

    /**
     * @var string
     */
    protected $remoteId;

    /**
     * @var string
     */
    protected $itemRemoteId;

    /**
     * @var float
     */
    protected $basePrice;

    /**
     * @var float
     */
    protected $price;

    /**
     * @var string
     */
    protected $baseCurrencyCode;

    /**
     * @var string
     */
    protected $currencyCode;

    /**
     * @var int
     */
    protected $quantity;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var string
     */
    protected $createdAt;

    public function __construct()
    {
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
    public function getItemRemoteId()
    {
        return $this->itemRemoteId;
    }

    /**
     * @param string $itemRemoteId
     */
    public function setItemRemoteId($itemRemoteId)
    {
        $this->itemRemoteId = $itemRemoteId;

        return $this;
    }

    /**
     * @return string
     */
    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    /**
     * @param string $currencyCode
     */
    public function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;

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
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param string $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return string
     */
    public function getRemoteId()
    {
        return (string) $this->remoteId ?: null;
    }

    /**
     * @param string $remoteId
     *
     * @return $this
     */
    public function setRemoteId($remoteId)
    {
        $this->remoteId = $remoteId;

        return $this;
    }

    /**
     * @return float
     */
    public function getBasePrice()
    {
        return (float) $this->basePrice ?: null;
    }

    /**
     * @param float $basePrice
     *
     * @return $this
     */
    public function setBasePrice($basePrice)
    {
        $this->basePrice = $basePrice;

        return $this;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return (float) $this->price ?: null;
    }

    /**
     * @param float $price
     *
     * @return $this
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

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
    public function getCode()
    {
        return (string) $this->code ?: null;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setCode($type)
    {
        $this->code = $type;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'service' => $this->getService(),
            'remoteId' => $this->getRemoteId(),
            'itemRemoteId' => $this->getItemRemoteId(),
            'basePrice' => $this->getBasePrice(),
            'price' => $this->getPrice(),
            'currencyCode' => $this->getCurrencyCode(),
            'baseCurrencyCode' => $this->getBaseCurrencyCode(),
            'quantity' => $this->getQuantity(),
            'code' => $this->getCode(),
            'createdAt' => $this->getCreatedAt(),
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
        $this->setRemoteId(isset($data['remoteId']) ? $data['remoteId'] : null);
        $this->setItemRemoteId(isset($data['itemRemoteId']) ? $data['itemRemoteId'] : null);
        $this->setBasePrice(isset($data['basePrice']) ? $data['basePrice'] : null);
        $this->setPrice(isset($data['price']) ? $data['price'] : null);
        $this->setCurrencyCode(isset($data['currencyCode']) ? $data['currencyCode'] : null);
        $this->setBaseCurrencyCode(isset($data['baseCurrencyCode']) ? $data['baseCurrencyCode'] : null);
        $this->setQuantity(isset($data['quantity']) ? $data['quantity'] : null);
        $this->setCode(isset($data['code']) ? $data['code'] : null);
        $this->setCreatedAt(isset($data['createdAt']) ? $data['createdAt'] : null);

        return $this;
    }
}
