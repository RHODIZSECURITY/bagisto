<?php

namespace Rhodiz\UspsFlat\Carriers;

use Webkul\Shipping\Carriers\AbstractShipping;
use Webkul\Checkout\Models\CartShippingRate;
use Webkul\Checkout\Facades\Cart;
use Illuminate\Support\Str;

class UspsFlat extends AbstractShipping
{
    /**
     * Payment method code
     *
     * @var string
     */
    protected $code  = 'usps_flat';

    public function calculate()
    {
        $cart = Cart::getCart();

        if (!$cart || !$cart->items->count()) {
            // Handle empty cart
            // Retorna un mensaje indicando que el carrito está vacío
            $cartShippingRate = new CartShippingRate;

            $cartShippingRate->carrier = $this->getCode();
            $cartShippingRate->carrier_title = $this->getConfigData('title') ?? 'USPS Flat Rate Shipping';
            $cartShippingRate->method = 'no_shipping';
            $cartShippingRate->method_title = 'Carrito vacío';
            $cartShippingRate->method_description = 'No hay productos en el carrito.';
            $cartShippingRate->price = 0;
            $cartShippingRate->base_price = 0;
            $cartShippingRate->error_message = 'Su carrito está vacío. Por favor, añada productos para continuar.';

            return [$cartShippingRate];
        }

        $totalWeight = 0;

        // Calculate total weight
        foreach ($cart->items as $item) {
            $totalWeight += $item->weight * $item->quantity;
        }

        if ($totalWeight <= 0) {
            // Handle invalid weight
            // Retorna un mensaje indicando que el peso es inválido
            $cartShippingRate = new CartShippingRate;

            $cartShippingRate->carrier = $this->getCode();
            $cartShippingRate->carrier_title = $this->getConfigData('title') ?? 'USPS Flat Rate Shipping';
            $cartShippingRate->method = 'invalid_weight';
            $cartShippingRate->method_title = 'Peso inválido';
            $cartShippingRate->method_description = 'El peso total del carrito es inválido.';
            $cartShippingRate->price = 0;
            $cartShippingRate->base_price = 0;
            $cartShippingRate->error_message = 'El peso de los productos en el carrito no es válido. Por favor, verifique los detalles de los productos.';

            return [$cartShippingRate];
        }

        $weight = $totalWeight; // in pounds

        $services = [];

        // Fetch configured rates from admin panel
        $configPath = 'sales.carriers.usps_flat';

        // Flat Rate Envelope and Small Box (applies to any weight up to 70 lbs)
        $services[] = [
            'name'     => 'Priority Mail Flat Rate Envelope',
            'cost'     => core()->getConfigData("{$configPath}.priority_mail_flat_rate_envelope") ,
            'delivery' => '1-3 business days',
        ];
        $services[] = [
            'name'     => 'Priority Mail Flat Rate Small Box',
            'cost'     => core()->getConfigData("{$configPath}.priority_mail_flat_rate_small_box") ,
            'delivery' => '1-3 business days',
        ];

        // First-Class Package Service (0 - 1 lb)
        if ($weight > 0 && $weight <= 1.0) {
            $services[] = [
                'name'     => 'First-Class Package Service',
                'cost'     => core()->getConfigData("{$configPath}.first_class_package_service_0_1_lb"),
                'delivery' => '1-5 business days',
            ];
        }

        // USPS Retail Ground
        if ($weight > 0 && $weight <= 1.0) {
            $services[] = [
                'name'     => 'USPS Retail Ground (0 - 1 lb)',
                'cost'     => core()->getConfigData("{$configPath}.usps_retail_ground_0_1_lb") ,
                'delivery' => '2-8 business days',
            ];
        } elseif ($weight > 1.0 && $weight <= 5.0) {
            $services[] = [
                'name'     => 'USPS Retail Ground (1 - 5 lb)',
                'cost'     => core()->getConfigData("{$configPath}.usps_retail_ground_1_5_lb") ,
                'delivery' => '2-8 business days',
            ];
        } elseif ($weight > 5.0 && $weight <= 10.0) {
            $services[] = [
                'name'     => 'USPS Retail Ground (5 - 10 lb)',
                'cost'     => core()->getConfigData("{$configPath}.usps_retail_ground_5_10_lb") ,
                'delivery' => '2-8 business days',
            ];
            // Priority Mail Medium Flat Rate Box
            $services[] = [
                'name'     => 'Priority Mail Medium Flat Rate Box (5 - 10 lb)',
                'cost'     => core()->getConfigData("{$configPath}.priority_mail_medium_flat_rate_box_5_10_lb") ,
                'delivery' => '1-3 business days',
            ];
        } elseif ($weight > 10.0 && $weight <= 20.0) {
            $services[] = [
                'name'     => 'USPS Retail Ground (10 - 20 lb)',
                'cost'     => core()->getConfigData("{$configPath}.usps_retail_ground_10_20_lb") ,
                'delivery' => '2-8 business days',
            ];
            // Priority Mail Large Flat Rate Box
            $services[] = [
                'name'     => 'Priority Mail Large Flat Rate Box (10 - 20 lb)',
                'cost'     => core()->getConfigData("{$configPath}.priority_mail_large_flat_rate_box_10_20_lb") ,
                'delivery' => '1-3 business days',
            ];
        } else {
            // If the weight exceeds the allowed limit
            $cartShippingRate = new CartShippingRate;

            $cartShippingRate->carrier = $this->getCode();
            $cartShippingRate->carrier_title = $this->getConfigData('title') ?? 'USPS Flat Rate Shipping';
            $cartShippingRate->method = 'exceeds_weight_limit';
            $cartShippingRate->method_title = 'Weight Exceeded';
            $cartShippingRate->method_description = 'The total weight of the cart exceeds the allowed limit for shipping.';
            $cartShippingRate->price = 0;
            $cartShippingRate->base_price = 0;
            $cartShippingRate->error_message = 'The total weight of your order exceeds the maximum limit. Please adjust your cart or contact support.';

            return [$cartShippingRate];
        }

        // Sort services by lowest cost
        usort($services, function ($a, $b) {
            return $a['cost'] <=> $b['cost'];
        });

        $result = [];

        $result = [];

        // Prepara las tarifas como objetos CartShippingRate
        foreach ($services as $service) {
            $cartShippingRate = new CartShippingRate;

            $cartShippingRate->carrier = $this->getCode();
            $cartShippingRate->carrier_title = $this->getConfigData('title') ?? 'USPS Flat Rate Shipping';
            $cartShippingRate->method = Str::slug($service['name'], '_');
            $cartShippingRate->method_title = $service['name'] . " - " . $totalWeight. " lbs";
            $cartShippingRate->method_description = $service['delivery'];
            $cartShippingRate->price = $service['cost'];
            $cartShippingRate->base_price = $service['cost'];

            $result[] = $cartShippingRate;
        }

        return $result;
    }

    /**
     * Payment method services
     *
     * @var string
     */
    protected $services  = [
        '4'      => 'Retail Ground', //este
        '16'     => 'Priority Mail Flat Rate Envelope', //este
        '28'     => 'Priority Mail Small Flat Rate Box', //este
        '61'     => 'First-Class Package Service' //este
    ];

    /**
     * get the allowed services
     *
     * @return $allowed_services
     */
    public function getServices()
    {
        $allowed_services = [];

        $config_services = core()->getConfigData('sales.carriers.usps.services');

        $services = explode(",", $config_services);

        foreach ($services as $service_code) {
            if (isset($this->services[$service_code])) {
                $allowed_services[$service_code] = $this->services[$service_code];
            }
        }

        return $allowed_services;
    }

    /**
     * Checks if payment method is available
     *
     * @return array
     */
    public function isAvailable()
    {
        return core()->getConfigData('sales.carriers.usps_flat.active');
    }
}
