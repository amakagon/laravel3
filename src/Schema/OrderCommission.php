<?php namespace Rem\BillingClient\Schema;

class OrderCommission extends Charge
{
    const CODE_PRODUCT_PROVISION = 'product_provision';
    const CODE_TRANSACTION_PROVISION = 'transaction_provision';
    const CODE_ROYALTY = 'royalty';
    const CODE_BOOST_PRICE = 'boost_price';

    /**
     * @var int
     */
    protected $quantity;

    /**
     * @var int
     */
    protected $currencyCode;

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
     * @return int
     */
    public function getCurrencyCode()
    {
        return $this->currencyCode ?: null;
    }

    /**
     * @param int $quantity
     * @param mixed $currency
     *
     * @return $this
     */
    public function setCurrencyCode($currency)
    {
        $this->currencyCode = $currency;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'code' => $this->getCode(),
            'basePrice' => $this->getBasePrice(),
            'price' => $this->getPrice(),
            'quantity' => $this->getQuantity(),
            'currencyCode' => $this->getCurrencyCode(),
        ];
    }

    /**
     * @param array $data
     *
     * @return $this
     */
    public function fromArray(array $data)
    {
        $this->setCode(isset($data['code']) ? $data['code'] : null);
        $this->setBasePrice(isset($data['basePrice']) ? $data['basePrice'] : null);
        $this->setPrice(isset($data['price']) ? $data['price'] : null);
        $this->setQuantity(isset($data['quantity']) ? $data['quantity'] : null);
        $this->setCurrencyCode(isset($data['currencyCode']) ? $data['currencyCode'] : null);

        return $this;
    }
}
