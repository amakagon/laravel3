<?php namespace Rem\BillingClient\Schema;

class OrderItem
{
    const TYPE_VIRTUAL = 'virtual';

    /**
     * @var string
     */
    protected $remoteId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $sku;

    /**
     * @var float
     */
    protected $basePrice;

    /**
     * @var float
     */
    protected $price;

    /**
     * @var float
     */
    protected $statementPrice;

    /**
     * @var string
     */
    protected $statementCurrencyCode;

    /**
     * @var OrderCommission[]
     */
    protected $commission;

    /**
     * @var int
     */
    protected $quantity;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $auctionId;

    /**
     * @var Customer
     */
    protected $seller;

    /**
     * @var OrderFee[]
     */
    protected $fees;

    /**
     * @var string
     */
    protected $paidAt;

    public function __construct()
    {
        $this->fees = [];
        $this->commission = [];
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
     * @return string
     */
    public function getName()
    {
        return (string) $this->name ?: null;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getSku()
    {
        return (string) $this->sku ?: null;
    }

    /**
     * @param string $sku
     *
     * @return $this
     */
    public function setSku($sku)
    {
        $this->sku = $sku;

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
    public function getCommission()
    {
        return $this->commission;
    }

    /**
     * @param OrderCommission $commission
     *
     * @return $this
     */
    public function addCommission($commission)
    {
        $this->commission[] = $commission;

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
    public function getType()
    {
        return (string) $this->type ?: null;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Customer
     */
    public function getSeller()
    {
        return $this->seller;
    }

    /**
     * @param Customer $seller
     *
     * @return $this
     */
    public function setSeller($seller)
    {
        $this->seller = $seller;

        return $this;
    }

    /**
     * @return OrderFee[]
     */
    public function getFees()
    {
        return $this->fees;
    }

    /**
     * @param OrderFee $fee
     *
     * @return $this
     */
    public function addFee($fee)
    {
        $this->fees[] = $fee;

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
     * @return float
     */
    public function getStatementPrice()
    {
        return (float) $this->statementPrice ?: null;
    }

    /**
     * @param float $statementPrice
     *
     * @return $this
     */
    public function setStatementPrice($statementPrice)
    {
        $this->statementPrice = (float) $statementPrice;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatementCurrencyCode()
    {
        return $this->statementCurrencyCode;
    }

    /**
     * @param string $statementCurrencyCode
     *
     * @return $this
     */
    public function setStatementCurrencyCode($statementCurrencyCode)
    {
        $this->statementCurrencyCode = $statementCurrencyCode ?: null;

        return $this;
    }

    /**
     * @return string
     */
    public function getPaidAt()
    {
        return $this->paidAt;
    }

    /**
     * @param string $paidAt
     *
     * @return $this
     */
    public function setPaidAt($paidAt)
    {
        $this->paidAt = $paidAt ?: null;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $fees = [];
        foreach ($this->getFees() as $fee) {
            $fees[] = $fee->toArray();
        }

        $commissions = [];
        foreach ($this->commission as $com) {
            $commissions[] = $com->toArray();
        }

        return [
            'remoteId' => $this->getRemoteId(),
            'name' => $this->getName(),
            'sku' => $this->getSku(),
            'basePrice' => $this->getBasePrice(),
            'price' => $this->getPrice(),
            'commissions' => $commissions,
            'quantity' => $this->getQuantity(),
            'type' => $this->getType(),
            'seller' => $this->getSeller()->toArray(),
            'fees' => $fees,
            'auctionId' => $this->getAuctionId(),
            'statementPrice' => $this->getStatementPrice(),
            'statementCurrencyCode' => $this->getStatementCurrencyCode(),
            'paidAt' => $this->getPaidAt(),
        ];
    }

    /**
     * @param array $data
     *
     * @return $this
     */
    public function fromArray(array $data)
    {
        $this->setRemoteId(isset($data['remoteId']) ? $data['remoteId'] : null);
        $this->setName(isset($data['name']) ? $data['name'] : null);
        $this->setSku(isset($data['sku']) ? $data['sku'] : null);
        $this->setBasePrice(isset($data['basePrice']) ? $data['basePrice'] : null);
        $this->setPrice(isset($data['price']) ? $data['price'] : null);
        $this->setQuantity(isset($data['quantity']) ? $data['quantity'] : null);
        $this->setType(isset($data['type']) ? $data['type'] : null);
        $this->setAuctionId(isset($data['auctionId']) ? $data['auctionId'] : null);
        $this->setStatementPrice(isset($data['statementPrice']) ? $data['statementPrice'] : null);
        $this->setStatementCurrencyCode(isset($data['statementCurrencyCode']) ? $data['statementCurrencyCode'] : null);
        $this->setPaidAt(isset($data['paidAt']) ? $data['paidAt'] : null);

        if (!empty($data['seller']['type'])) {
            $seller = Customer::getModelBasedOnType($data['seller']['type']);

            if ($seller) {
                $seller->fromArray($data['seller']);
                $this->setSeller($seller);
            }
        }

        if (!empty($data['fees'])) {
            foreach ($data['fees'] as $fee) {
                $this->addFee((new OrderFee())->fromArray($fee));
            }
        }

        if (!empty($data['commissions'])) {
            foreach ($data['commissions'] as $commission) {
                $this->addCommission((new OrderCommission())->fromArray($commission));
            }
        }

        return $this;
    }
}
