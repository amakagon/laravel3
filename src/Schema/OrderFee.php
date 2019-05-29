<?php namespace Rem\BillingClient\Schema;

class OrderFee extends Charge
{
    const CODE_DISCOUNT = 'discount';
    const CODE_PAYMENT_FEE = 'payment_fee';
    const CODE_ESCROW = 'escrow';
}
