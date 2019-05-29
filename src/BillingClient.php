<?php namespace Rem\BillingClient;

use Rem\BillingClient\Contract\BillingClientContract;
use Rem\BillingClient\Exception\BillingServiceException;
use Rem\BillingClient\Exception\CustomerDocumentsNotFound;
use Rem\BillingClient\Exception\DownloadRequestException;
use Rem\BillingClient\Exception\GenerationRequestException;
use Rem\BillingClient\Schema\Commission;
use Rem\BillingClient\Schema\Document;
use Rem\BillingClient\Schema\DocumentOld;
use Rem\BillingClient\Schema\Order;
use Rem\BillingClient\Schema\Refund;
use Rem\RemClient\RemClient;
use Psr\Log\LoggerInterface;

/**
 * Marketplace client.
 */
class BillingClient extends RemClient implements BillingClientContract
{
    const DOCUMENTS_NOT_FOUND_FOR_CONSUMER = 'No documents found for selected customer';
    const DOCUMENTS_NOT_FOUND_FOR_FILTERS = 'No documents found for selected filters';
    /**
     * Simple Authentication api endpoint part of url.
     *
     * @var string
     */
    protected $apiEndpoint = '';

    /**
     * @param array $config
     * @param LoggerInterface $logger
     * @param bool $isJson
     */
    public function __construct(array $config, LoggerInterface $logger = null, $isJson = true)
    {
        foreach ($config['endpoints'] as $endpoint => $endpointPath) {
            $this->{$endpoint . 'Endpoint'} = $endpointPath;
        }

        $this->isJson = $isJson;

        parent::__construct($config, $logger);
    }

    /**
     * Sets Api endpoint.
     *
     * @param string $endpoint
     *
     * @return $this
     */
    public function setApiEndpoint($endpoint)
    {
        $this->apiEndpoint = $endpoint;

        return $this;
    }

    /**
     * @param string $customerId UUID
     * @param bool $rawData Return Order object by default or raw array response
     * @param bool $showCurrent
     *
     * @return array|Document[]
     */
    public function getDocumentsOld($customerId, $rawData = false, $showCurrent = false)
    {
        $documents = [];

        $url = $this->apiEndpoint . 'customer/' . $customerId . '/documents';

        $res = $this->get($url, [], [
            'headers' => [
                'Show-current' => (int) $showCurrent,
            ],
        ]);

        if (empty($res) || !is_array($res)) {
            return [];
        }

        if ($rawData) {
            return $res;
        }

        foreach ($res as $doc) {
            $documents[] = (new DocumentOld())->fromArray($doc);
        }

        return $documents;
    }

    /**
     * @param string $customerId UUID
     * @param bool $rawData Return Order object by default or raw array response
     * @param bool $showCurrent
     *
     * @return array|Document[]
     */
    public function getDocuments($customerId, $rawData = false, $showCurrent = false)
    {
        $documents = [];

        $url = $this->apiEndpoint . 'customer/' . $customerId . '/documents';

        $res = $this->get($url, [], [
            'headers' => [
                'Show-current' => (int) $showCurrent,
            ],
        ]);

        if (empty($res) || !is_array($res)) {
            return [];
        }

        if ($rawData) {
            return $res;
        }

        foreach ($res as $projectionName => $projection) {
            foreach ($projection as $periodType => $obj) {
                $allowedFormats = $obj['properties']['allowedFormats'];
                foreach ($obj['list'] as $doc) {
                    $document = new Document();
                    $document->setType($projectionName);
                    $document->setPeriodType($periodType);
                    $document->setAllowedFormats($allowedFormats);
                    $document->fromArray($doc);
                    $documents[] = $document;
                }
            }
        }

        return $documents;
    }

    /**
     * @param array|Order $order
     *
     * @return bool
     */
    public function createOrder($order)
    {
        $data = ($order instanceof Order)
            ? $order->toArray()
            : $order;

        $this->post($this->apiEndpoint . 'order', $data);

        return $this->getLastResponse() && self::STATUS_CREATED === $this->getLastResponse()->getStatusCode();
    }

    /**
     * @param array|Order $order
     *
     * @return bool
     */
    public function updateOrder($order)
    {
        $data = ($order instanceof Order)
            ? $order->toArray()
            : $order;

        $this->put($this->apiEndpoint . 'order', $data);

        return $this->getLastResponse() && self::STATUS_OK === $this->getLastResponse()->getStatusCode();
    }

    /**
     * @param string $orderId UUID
     * @param bool $rawData
     *
     * @return null|array|Order
     */
    public function findOrder($orderId, $rawData = false)
    {
        $res = $this->get($this->apiEndpoint . 'order/' . $orderId);

        if (empty($res)
            || !is_array($res)
            || !$this->getLastResponse()
            || self::STATUS_OK !== $this->getLastResponse()->getStatusCode()
        ) {
            return null;
        }

        return $rawData
            ? $res
            : (new Order())->fromArray($res);
    }

    /**
     * @param $commission
     *
     * @return bool
     */
    public function chargeCommission($commission)
    {
        $data = ($commission instanceof Commission)
            ? $commission->toArray()
            : $commission;

        $this->post($this->apiEndpoint . 'commission', $data);

        return $this->getLastResponse() && self::STATUS_CREATED === $this->getLastResponse()->getStatusCode();
    }

    /**
     * @param $refund
     *
     * @return bool
     */
    public function createRefund($refund)
    {
        $data = ($refund instanceof Refund)
            ? $refund->toArray()
            : $refund;

        $this->post($this->apiEndpoint . 'refund', $data);

        return $this->getLastResponse() && self::STATUS_CREATED === $this->getLastResponse()->getStatusCode();
    }

    /**
     * Returns redirection url to Blob storage
     *
     * @param string $customerUUID
     * @param string $requestHash
     * @param string $archiveType
     * @param bool $showCurrent
     *
     * @throws DownloadRequestException
     *
     * @return string
     */
    public function downloadDocument($customerUUID, $requestHash, $archiveType, $showCurrent = false)
    {
        $url = $this->apiEndpoint;
        $url .= 'customer/' . $customerUUID . '/archive/' . $archiveType;
        $url .= '/' . $requestHash . '/';

        $this->setLoadContent(false);
        $this->get($url, [], [
            'allow_redirects' => [
                'max' => 0,
                'track_redirects' => true,
            ],
            'headers' => [
                'Accept' => 'application/zip',
                'Show-current' => (int) $showCurrent,
            ],
        ]);

        if (
            !$this->getLastResponse() ||
            !in_array($this->getLastResponse()->getStatusCode(), [self::STATUS_CREATED, self::STATUS_OK, self::STATUS_MOVED_PERMANENTLY])
        ) {
            $message = '';
            if ($this->getLastResponse()) {
                $message = $this->getLastResponse()->getStatusCode() . ' | ' . ((string) $this->getLastResponse()->getBody());
            }

            throw new DownloadRequestException('There was a problem with document download | ' . $message);
        }

        $this->setLoadContent(true);

        return $this->getLastResponse()->getHeaderLine('Location');
    }

    /**
     * @param string $url
     * @param bool $showCurrent
     *
     * @return bool
     */
    public function requestDocument($url, $showCurrent = false)
    {
        $this->get($url, [], [
            'headers' => [
                'Show-current' => (int) $showCurrent,
            ],
        ]);

        return $this->getLastResponse() && self::STATUS_OK === $this->getLastResponse()->getStatusCode();
    }

    /**
     * @param string $customerUUID
     * @param string $requestHash
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @param array $documentTypes
     *
     * @throws \Exception
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function requestGenerationOfArchiveFile(
        $customerUUID,
        $requestHash,
        \DateTime $dateFrom,
        \DateTime $dateTo,
        array $documentTypes
    ) {
        $url = $this->apiEndpoint;
        $url .= 'customer/' . $customerUUID . '/requestArchive/' . $requestHash;
        $url .= '/' . $dateFrom->format('Y-m') . '_' . $dateTo->format('Y-m');
        $url .= '/' . implode(',', $documentTypes);
        $url .= '/';

        $this->get($url);

        if (
            !$this->getLastResponse()
            || self::STATUS_CREATED !== $this->getLastResponse()->getStatusCode()
        ) {
            $message = '';
            if ($this->getLastResponse()) {
                $message = $this->getLastResponse()->getStatusCode() . ' | ' . ((string) $this->getLastResponse()->getBody());
            }

            throw new GenerationRequestException('Archival files generation request not successful | ' . $message);
        }

        return $this->getLastResponse();
    }

    /**
     * @param string $customerUUID
     * @param string $date
     * @param bool $showCurrent
     *
     * @throws GenerationRequestException
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function requestGenerationOfDocuments(
        $customerUUID,
        $date,
        $showCurrent = false
    ) {
        $quarterly = is_int(strpos($date, 'q'));

        $url = $this->apiEndpoint;
        $url .= 'customer/' . $customerUUID . '/' . ($quarterly ? 'requestQuarterly' : 'requestMonthly');
        $url .= '/' . $date;
        $url .= '/' . ($quarterly ? 'allQuarterly' : 'allMonthly') . '/';

        $this->get($url, [], [
            'headers' => [
                'Show-current' => (int) $showCurrent,
            ],
        ]);

        if (
            !$this->getLastResponse()
            || !in_array($this->getLastResponse()->getStatusCode(), [self::STATUS_CREATED, self::STATUS_OK])
        ) {
            $message = '';
            if ($this->getLastResponse()) {
                $message = $this->getLastResponse()->getStatusCode() . ' | ' . ((string) $this->getLastResponse()->getBody());
            }

            throw new GenerationRequestException('Monthly files generation request not successful | ' . $message);
        }

        return $this->getLastResponse();
    }

    /**
     * @throws BillingServiceException
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getDocumentTypes()
    {
        $url = $this->apiEndpoint . 'dictionary/documentTypes/';

        $this->get($url);

        if (
            !$this->getLastResponse()
            || self::STATUS_OK !== $this->getLastResponse()->getStatusCode()
            || false !== strpos($this->getLastResponse()->getHeaderLine('Content-Type'), 'text/html')
        ) {
            throw new BillingServiceException('No document types provided');
        }

        return $this->getLastResponse();
    }

    /**
     * @param string $customerUUID
     * @param string $documentTypes
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     *
     * @throws CustomerDocumentsNotFound
     * @throws GenerationRequestException
     *
     * @return bool
     */
    public function sendArchiveRequest(string $customerUUID, string $documentTypes, \DateTime $dateFrom, \DateTime $dateTo)
    {
        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ];

        $data = [];
        $data['customerId'] = $customerUUID;
        $data['documentTypes'] = $documentTypes;
        $data['range'] = $dateFrom->format('Y-m') . '_' . $dateTo->format('Y-m');

        $this->post($this->apiEndpoint . 'archiveOnDemand/create', $data, $options);

        if (empty($this->getLastResponse())) {
            throw new GenerationRequestException('Lack of response');
        }

        $response = @json_decode((string) $this->getLastResponse()->getBody());

        if (self::STATUS_BAD_REQUEST === $this->getLastResponse()->getStatusCode()) {
            if (!isset($response->message)) {
                throw new GenerationRequestException('Lack of response body');
            }
            if (self::DOCUMENTS_NOT_FOUND_FOR_CONSUMER === $response->message || self::DOCUMENTS_NOT_FOUND_FOR_FILTERS === $response->message) {
                throw new CustomerDocumentsNotFound($response->message, $this->getLastResponse()->getStatusCode());
            }
            throw new GenerationRequestException($response->message, $this->getLastResponse()->getStatusCode());
        }
        $success = $this->getLastResponse() && self::STATUS_CREATED === $this->getLastResponse()->getStatusCode();
        if (!$success) {
            $message = 'Request generation has been failed due to reason | ' . ((string) $this->getLastResponse()->getBody());
            throw new GenerationRequestException($message, $this->getLastResponse()->getStatusCode());
        }
        return $success;
    }
}
