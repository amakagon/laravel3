<?php namespace Rem\BillingClient\Schema;

class DocumentOld
{
    const TYPE_MONTHLY_SELLING_SERVICES = 'monthlySellingServices';
    const TYPE_MONTHLY_SELLING_SERVICES_SUMMARY = 'monthlySellingServicesSummary';
    const TYPE_MONTHLY_SUMMARY_SELLER_BUSINESS = 'monthlySummarySellerBusiness';
    const TYPE_MONTHLY_SUMMARY_SELLER_BUSINESS_REFUNDS = 'monthlySummarySellerBusinessRefunds';
    const TYPE_MONTHLY_SUMMARY_SELLER_INDIVIDUAL = 'monthlySummarySellerIndividual';
    const TYPE_MONTHLY_SUMMARY_SELLER_INDIVIDUAL_REFUNDS = 'monthlySummarySellerIndividualRefunds';

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $createdAt;

    /**
     * @var string
     */
    protected $billingDate;

    /**
     * @var array
     */
    protected $allowedFormats;

    /**
     * @var Location
     */
    protected $location;

    /**
     * @var string
     */
    protected $billingPeriod;

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
     * @return string
     */
    public function getBillingDate()
    {
        return (string) $this->billingDate ?: null;
    }

    /**
     * @param string $billingDate
     *
     * @return $this
     */
    public function setBillingDate($billingDate)
    {
        $this->billingDate = $billingDate;

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
     * @return Location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param Location $location
     *
     * @return $this
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @return string
     */
    public function getBillingPeriod()
    {
        return (string) $this->billingPeriod ?: null;
    }

    /**
     * @param string $billingPeriod
     *
     * @return $this
     */
    public function setBillingPeriod($billingPeriod)
    {
        $this->billingPeriod = $billingPeriod;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $location = $this->getLocation()
            ? $this->getLocation()->toArray()
            : null;

        return [
            'type' => $this->getType(),
            'createdAt' => $this->getCreatedAt(),
            'billingDate' => $this->getBillingDate(),
            'billingPeriod' => $this->getBillingPeriod(),
            'allowedFormats' => $this->getAllowedFormats(),
            'location' => $location,
        ];
    }

    /**
     * @param array $data
     *
     * @return $this
     */
    public function fromArray(array $data)
    {
        $this->setType(isset($data['type']) ? $data['type'] : null);
        $this->setCreatedAt(isset($data['createdAt']) ? $data['createdAt'] : null);
        $this->setBillingDate(isset($data['billingDate']) ? $data['billingDate'] : null);
        $this->setBillingPeriod(isset($data['billingPeriod']) ? $data['billingPeriod'] : null);
        $this->setAllowedFormats(isset($data['allowedFormats']) ? $data['allowedFormats'] : null);
        $this->setLocation(isset($data['location']) ? (new Location())->fromArray($data['location']) : null);

        return $this;
    }
}
