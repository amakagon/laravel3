<?php namespace Rem\BillingClient\Schema;

use Rem\BillingClient\Schema\Customer\Company;
use Rem\BillingClient\Schema\Customer\ID;
use Rem\BillingClient\Schema\Customer\Individual;
use Rem\BillingClient\Schema\Customer\MySelf;

abstract class Customer
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @return string
     */
    public function getType()
    {
        return (string) $this->type;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    protected function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return array
     */
    public abstract function toArray();

    /**
     * @param string $type
     *
     * @return Company|ID|Individual|MySelf|null
     */
    public static function getModelBasedOnType($type)
    {
        switch ($type) {
            case MySelf::TYPE:
                return new MySelf();
            case ID::TYPE:
                return new ID();
            case Individual::TYPE:
                return new Individual();
            case Company::TYPE:
                return new Company();
        }

        return null;
    }
}
