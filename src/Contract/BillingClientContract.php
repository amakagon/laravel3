<?php namespace Rem\BillingClient\Contract;

use Rem\RemClient\Paginate\PaginatedInterface;
use Rem\BillingClient\BillingClientInterface;

/**
 * Billing client interface.
 */
interface BillingClientContract extends BillingClientInterface, PaginatedInterface
{
}
