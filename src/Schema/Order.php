<?php namespace Rem\BillingClient\Schema;

class Order
{
    /**
     * @var string
     */
    protected $service;

    /**
     * @var string
     */
    protected $incrementId;

    /**
     * @var string
     */
    protected $purchasedAt;

    /**
     * @var string
     */
    protected $paidAt;

    /**
     * @var Customer
     */
    protected $buyer;

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
     * @var OrderItem[]
     */
    protected $items;

    public function __construct()
    {
        $this->items = [];
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
    public function getIncrementId()
    {
        return (string) $this->incrementId ?: null;
    }

    /**
     * @param string $incrementId
     *
     * @return $this
     */
    public function setIncrementId($incrementId)
    {
        $this->incrementId = $incrementId;

        return $this;
    }

    /**
     * @return string
     */
    public function getPurchasedAt()
    {
        return (string) $this->purchasedAt ?: null;
    }

    /**
     * @param string $purchasedAt
     *
     * @return $this
     */
    public function setPurchasedAt($purchasedAt)
    {
        $this->purchasedAt = $purchasedAt;

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
    public function getBuyer()
    {
        return $this->buyer;
    }

    /**
     * @param Customer $buyer
     *
     * @return $this
     */
    public function setBuyer($buyer)
    {
        $this->buyer = $buyer;

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
     * @return OrderItem[]
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param OrderItem $item
     *
     * @return $this
     */
    public function addItem($item)
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $itemsArray = [];
        foreach ($this->getItems() as $item) {
            $itemsArray[] = $item->toArray();
        }

        return [
            'service' => $this->getService(),
            'incrementId' => $this->getIncrementId(),
            'purchasedAt' => $this->getPurchasedAt(),
            'paidAt' => $this->getPaidAt(),
            'buyer' => $this->getBuyer()->toArray(),
            'baseCurrencyCode' => $this->getBaseCurrencyCode(),
            'currencyCode' => $this->getCurrencyCode(),
            'exchangeRate' => $this->getExchangeRate(),
            'items' => $itemsArray,
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
        $this->setIncrementId(isset($data['incrementId']) ? $data['incrementId'] : null);
        $this->setPurchasedAt(isset($data['purchasedAt']) ? $data['purchasedAt'] : null);
        $this->setPaidAt(isset($data['paidAt']) ? $data['paidAt'] : null);
        $this->setBaseCurrencyCode(isset($data['baseCurrencyCode']) ? $data['baseCurrencyCode'] : null);
        $this->setCurrencyCode(isset($data['currencyCode']) ? $data['currencyCode'] : null);
        $this->setExchangeRate(isset($data['exchangeRate']) ? $data['exchangeRate'] : null);

        if (!empty($data['buyer']['type'])) {
            $buyer = Customer::getModelBasedOnType($data['buyer']['type']);

            if ($buyer) {
                $buyer->fromArray($data['buyer']);
                $this->setBuyer($buyer);
            }
        }

        if (!empty($data['items'])) {
            foreach ($data['items'] as $item) {
                $this->addItem((new OrderItem())->fromArray($item));
            }
        }

        return $this;
    }
}
