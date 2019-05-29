<?php
namespace Rem\BillingClient;

use Rem\BillingClient\Exception\DownloadRequestException;
use Rem\BillingClient\Schema\Document;
use Rem\BillingClient\Schema\DocumentOld;
use Rem\BillingClient\Schema\Order;

interface BillingClientInterface
{
    /**
     * Sets Api endpoint.
     *
     * @param string $endpoint
     *
     * @return $this
     */
    public function setApiEndpoint($endpoint);

    /**
     * @param string $customerId UUID
     * @param bool $rawData Return Order object by default or raw array response
     * @param bool $showCurrent
     *
     * @return array|Document[]
     */
    public function getDocuments($customerId, $rawData = false, $showCurrent = false);

    /**
     * @param string $customerId UUID
     * @param bool $rawData Return Order object by default or raw array response
     * @param bool $showCurrent
     *
     * @return array|DocumentOld[]
     */
    public function getDocumentsOld($customerId, $rawData = false, $showCurrent = false);

    /**
     * @param array|Order $order
     *
     * @return bool
     */
    public function createOrder($order);

    /**
     * @param array|Order $order
     *
     * @return bool
     */
    public function updateOrder($order);

    /**
     * @param $refund
     *
     * @return bool
     */
    public function createRefund($refund);

    /**
     * @param string $orderId UUID
     * @param bool $rawData
     *
     * @return null|array|Order
     */
    public function findOrder($orderId, $rawData = false);

    /**
     * @param $commission
     *
     * @return bool
     */
    public function chargeCommission($commission);

    /**
     * Returns redirection url to Blob storage
     *
     * @param $customerUUID
     * @param $requestHash
     * @param $archiveType
     * @param bool $showCurrent
     * @return string
     */
    public function downloadDocument($customerUUID, $requestHash, $archiveType, $showCurrent = false);

    /**
     * @param string $url
     * @param bool $showCurrent
     *
     * @return bool
     */
    public function requestDocument($url, $showCurrent = false);

    /**
     * @param string $customerUUID
     * @param array $documentTypes
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     *
     * @return bool
     */
    public function sendArchiveRequest(string $customerUUID, string $documentTypes, \DateTime $dateFrom, \DateTime $dateTo);
}
