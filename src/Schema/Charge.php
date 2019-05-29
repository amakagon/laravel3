<?php namespace Rem\BillingClient\Schema;

abstract class Charge
{
    /**
     * @var string
     */
    protected $code;

    /**
     * @var float
     */
    protected $basePrice;

    /**
     * @var float
     */
    protected $price;

    /**
     * @return string
     */
    public function getCode()
    {
        return (string) $this->code ?: null;
    }

    /**
     * @param string $code
     *
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;

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
     * @return array
     */
    public function toArray()
    {
        return [
            'code' => $this->getCode(),
            'basePrice' => $this->getBasePrice(),
            'price' => $this->getPrice(),
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

        return $this;
    }
}
