<?php

namespace Rhodiz\Stripe\Payment;

use Webkul\Payment\Payment\Payment;
use Illuminate\Support\Facades\Storage;
use Webkul\Checkout\Facades\Cart;

class Stripe extends Payment
{
    /**
     * Payment method code
     *
     * @var string
     */
    protected $code  = 'stripe';

    public function getRedirectUrl(): string
    {
        return route('stripe.process');
    }

    /**
     * Checks if the cart grand total is greater than 0.5.
     *
     * @return bool
     */
    public function isAvailable(): bool
    {
        //return core()->getConfigData('sales.payments.stripe.active');
        return Cart::getCart()->grand_total >= 0.5;
    }

    /**
     * Get payment method image.
     *
     * @return array
     */
    public function getImage(): string
    {
        $url = core()->getConfigData('sales.payment_methods.stripe.logo_image') ;//$this->getConfigData('image');

        return $url ? Storage::url($url) : '';
    }
}
