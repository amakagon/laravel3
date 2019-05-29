<?php namespace Rem\BillingClient\Schema;

class Document
{
    const TYPE_SUMMARY_SELLER = 'summarySeller';
    const TYPE_SELLING_REPORT = 'sellingReport';
    const TYPE_SELLER_SALES = 'sellerSales';
    const TYPE_SELLER_REFUNDS = 'sellerRefunds';
    const TYPE_SELLER_COMMISSIONS = 'sellerCommissions';
    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $periodType;

    /**
     * @var string
     */
    protected $period;

    /**
     * @var string
     */
    protected $relationType;

    /**
     * @var string
     */
    protected $createdAt;

    /**
     * @var string
     */
    protected $generatedAt;

    /**
     * @var array
     */
    protected $allowedFormats;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var string
     */
    protected $url;

    public function __construct()
    {
        $this->allowedFormats = [];
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
     * @return string
     */
    public function getCreatedAt()
    {
        return (string) $this->createdAt ?: null;
    }

    /**
     * @param string $createdAt
     *
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return array
     */
    public function getAllowedFormats()
    {
        return $this->allowedFormats;
    }

    /**
     * @param array $allowedFormats
     *
     * @return $this
     */
    public function setAllowedFormats($allowedFormats)
    {
        $this->allowedFormats = $allowedFormats;

        return $this;
    }

    /**
     * @return string
     */
    public function getPeriodType()
    {
        return (string) $this->periodType ?: null;
    }

    /**
     * @param string $periodType
     *
     * @return $this
     */
    public function setPeriodType($periodType)
    {
        $this->periodType = $periodType;

        return $this;
    }

    /**
     * @return string
     */
    public function getPeriod()
    {
        return $this->period ?: null;
    }

    /**
     * @param string $period
     *
     * @return $this
     */
    public function setPeriod($period)
    {
        $this->period = $period;

        return $this;
    }

    /**
     * @return string
     */
    public function getRelationType()
    {
        return $this->relationType ?: null;
    }

    /**
     * @param string $relationType
     *
     * @return $this
     */
    public function setRelationType($relationType)
    {
        $this->relationType = $relationType;

        return $this;
    }

    /**
     * @return string
     */
    public function getGeneratedAt()
    {
        return $this->generatedAt ?: null;
    }

    /**
     * @param string $generatedAt
     *
     * @return $this
     */
    public function setGeneratedAt($generatedAt)
    {
        $this->generatedAt = $generatedAt;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status ?: null;
    }

    /**
     * @param string $status
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url ?: null;
    }

    /**
     * @param string $url
     *
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'type' => $this->getType(),
            'periodType' => $this->getPeriodType(),
            'allowedFormats' => $this->getAllowedFormats(),
            'period' => $this->getPeriod(),
            'relationType' => $this->getRelationType(),
            'createdAt' => $this->getCreatedAt(),
            'generatedAt' => $this->getGeneratedAt(),
            'status' => $this->getStatus(),
            'url' => $this->getUrl(),
        ];
    }

    /**
     * @param array $data
     *
     * @return $this
     */
    public function fromArray(array $data)
    {
        $this->setPeriod(isset($data['period']) ? $data['period'] : null);
        $this->setRelationType(isset($data['relationType']) ? $data['relationType'] : null);
        $this->setCreatedAt(isset($data['createdAt']) ? $data['createdAt'] : null);
        $this->setGeneratedAt(isset($data['generatedAt']) ? $data['generatedAt'] : null);
        $this->setStatus(isset($data['status']) ? $data['status'] : null);
        $this->setUrl(isset($data['url']) ? $data['url'] : null);

        return $this;
    }
}
