<?php namespace Rem\BillingClient\Schema;

class Location
{
    const TYPE_BLOB = 'blob';

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $url;

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
    public function getUrl()
    {
        return (string) $this->url ?: null;
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
     * @param array $data
     *
     * @return $this
     */
    public function fromArray(array $data)
    {
        $this->setType(isset($data['type']) ? $data['type'] : null);
        $this->setUrl(isset($data['url']) ? $data['url'] : null);

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'type' => $this->getType(),
            'url' => $this->getUrl(),
        ];
    }
}
