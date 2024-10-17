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

    public function calculate1()
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
            return [/*$cartShippingRate*/];
        }

        $totalWeight = 0;

        // Calculate total weight
        foreach ($cart->items as $item) {
            $totalWeight += $item->weight * $item->quantity;
        }

        if ($totalWeight <= 0) {
            // Handle invalid weight
            // Retorna un mensaje indicando que el peso es inválido
            /*$cartShippingRate = new CartShippingRate;

            $cartShippingRate->carrier = $this->getCode();
            $cartShippingRate->carrier_title = $this->getConfigData('title') ?? 'USPS Flat Rate Shipping';
            $cartShippingRate->method = 'invalid_weight';
            $cartShippingRate->method_title = 'Peso inválido';
            $cartShippingRate->method_description = 'El peso total del carrito es inválido.';
            $cartShippingRate->price = 0;
            $cartShippingRate->base_price = 0;
            $cartShippingRate->error_message = 'El peso de los productos en el carrito no es válido. Por favor, verifique los detalles de los productos.';
            */
            return [/*$cartShippingRate*/];
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

            return [/*$cartShippingRate*/];
        }

        // Sort services by lowest cost
        usort($services, function ($a, $b) {
            return $a['cost'] <=> $b['cost'];
        });

        $result = [];

        // Prepara las tarifas como objetos CartShippingRate
        foreach ($services as $service) {
            //Los servicios con costo cero no se tendran en cuenta
            if ($service['cost'] > 0) {
                $cartShippingRate = new CartShippingRate;

                $cartShippingRate->carrier = $this->getCode();
                $cartShippingRate->carrier_title = $this->getConfigData('title') ?? 'USPS Flat Rate Shipping';
                $cartShippingRate->method = Str::slug($service['name'], '_');
                $cartShippingRate->method_title = $service['name'] . " - (" . $totalWeight. " lbs)";
                $cartShippingRate->method_description = $service['delivery'];
                $cartShippingRate->price = $service['cost'];
                $cartShippingRate->base_price = $service['cost'];

                $result[] = $cartShippingRate;
            }
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
     * Checks if payment method is available
     *
     * @return array
     */
    public function isAvailable()
    {
        return core()->getConfigData('sales.carriers.usps_flat.active');
    }

    public function calculate()
    {
        $cart = Cart::getCart();

        if (!$cart || !$cart->items->count()) {
            // Handle empty cart
            $cartShippingRate = new CartShippingRate;

            $cartShippingRate->carrier = $this->getCode();
            $cartShippingRate->carrier_title = $this->getConfigData('title') ?? 'USPS Optimized Flat Rate Shipping';
            $cartShippingRate->method = 'no_shipping';
            $cartShippingRate->method_title = 'Empty Cart';
            $cartShippingRate->method_description = 'There are no products in the cart.';
            $cartShippingRate->price = 0;
            $cartShippingRate->base_price = 0;
            $cartShippingRate->error_message = 'Your cart is empty. Please add products to continue.';

            return [$cartShippingRate];
        }

        // Define weight classification thresholds (in lbs)
        $lightWeightThreshold = 0.5;  // <= 0.5 lbs is light
        $mediumWeightThreshold = 1.5; // 0.51 - 1.5 lbs is medium
        // > 1.5 lbs is heavy

        // Define capacity for each package type
        $flatRateEnvelopeCapacityLight = 4;   // Can hold 5 lightweight items
        $flatRateEnvelopeCapacityMedium = 2;  // Can hold 3 medium items

        $flatRateSmallBoxCapacityLight = 10;  // Can hold 10 lightweight items
        $flatRateSmallBoxCapacityMedium = 4;  // Can hold 5 medium items
        $flatRateSmallBoxCapacityHeavy = 2;   // Can hold 2 heavy items

        $flatRateMediumBoxCapacity = 10;      // Can hold 15 mixed items (light, medium, heavy)
        $flatRateLargeBoxCapacity = 15;       // Can hold 25 mixed items (light, medium, heavy)

        // Classify items in the cart
        $firstClassItems = 0;
        $lightItems = 0;
        $mediumItems = 0;
        $heavyItems = 0;

        $totalWeight = 0;
        $totalItems = 0;

        $debugString = "";

        foreach ($cart->items as $item) {
            $weight = $item->weight;

            if ($weight <= $lightWeightThreshold) {
                $lightItems += $item->quantity;
            } elseif ($weight <= $mediumWeightThreshold) {
                $mediumItems += $item->quantity;
            } else {
                $heavyItems += $item->quantity;
            }

            if ($weight <= 1) {
                $firstClassItems += $item->quantity;
            }

            $totalWeight += $weight;
            $totalItems += $item->quantity;

            $debugString .= "{$weight}|";
        }

        // Calculate how many envelopes or boxes are needed for each classification
        $numEnvelopesLight = ceil($lightItems / $flatRateEnvelopeCapacityLight);
        $numEnvelopesMedium = ceil($mediumItems / $flatRateEnvelopeCapacityMedium);

        $numSmallBoxesLight = ceil($lightItems / $flatRateSmallBoxCapacityLight);
        $numSmallBoxesMedium = ceil($mediumItems / $flatRateSmallBoxCapacityMedium);
        $numSmallBoxesHeavy = ceil($heavyItems / $flatRateSmallBoxCapacityHeavy);

        $numMediumBoxes = ceil(($lightItems + $mediumItems + $heavyItems) / $flatRateMediumBoxCapacity);
        $numLargeBoxes = ceil(($lightItems + $mediumItems + $heavyItems) / $flatRateLargeBoxCapacity);

        // Calculate total shipping cost based on the required number of envelopes and boxes
        $configPath = 'sales.carriers.usps_flat';

        $envelopeBaseCost = core()->getConfigData("{$configPath}.priority_mail_flat_rate_envelope") ;
        $smallBoxBaseCost = core()->getConfigData("{$configPath}.priority_mail_flat_rate_small_box") ;
        $mediumBoxBaseCost = core()->getConfigData("{$configPath}.priority_mail_medium_flat_rate_box") ;
        $largeBoxBaseCost = core()->getConfigData("{$configPath}.priority_mail_large_flat_rate_box");
        $firstClassBaseCost = core()->getConfigData("{$configPath}.first_class_package_service");

        $envelopeTotalCost = ($numEnvelopesLight + $numEnvelopesMedium) * $envelopeBaseCost;
        $smallBoxTotalCost = ($numSmallBoxesLight + $numSmallBoxesMedium + $numSmallBoxesHeavy) * $smallBoxBaseCost;
        $mediumBoxTotalCost = $numMediumBoxes * $mediumBoxBaseCost;
        $largeBoxTotalCost = $numLargeBoxes * $largeBoxBaseCost;

        $services = [];

        // Add the calculated rates to the services array
        if ($heavyItems == 0) {
            $services[] = [
                'name'     => 'Priority Mail Flat Rate Envelope',
                'cost'     => $envelopeTotalCost,
                'delivery' => '1-3 business days',
                'boxes'    => $numEnvelopesLight + $numEnvelopesMedium,
            ];
        }

        $numSmallBoxes = $numSmallBoxesLight + $numSmallBoxesMedium + $numSmallBoxesHeavy;
        $services[] = [
            'name'     => 'Priority Mail Flat Rate Small Box',
            'cost'     => $smallBoxTotalCost,
            'delivery' => '1-3 business days',
            'boxes'    => $numSmallBoxes,
        ];

        if (($lightItems + $mediumItems + $heavyItems) > 1) {
            $services[] = [
                'name'     => 'Priority Mail Flat Rate Medium Box',
                'cost'     => $mediumBoxTotalCost,
                'delivery' => '1-3 business days',
                'boxes'    => $numMediumBoxes,
            ];
        }

        if (($lightItems + $mediumItems + $heavyItems) > 1) {
            $services[] = [
                'name'     => 'Priority Mail Flat Rate Large Box',
                'cost'     => $largeBoxTotalCost,
                'delivery' => '1-3 business days',
                'boxes'    => $numLargeBoxes,
            ];
        }

        if ( $firstClassItems == $totalItems) {

            $firstClassTotalCost = ($firstClassItems) * $firstClassBaseCost;

            $services[] = [
                'name'     => 'First-Class Package Service',
                'cost'     => $firstClassTotalCost,
                'delivery' => '1-5 business days',
                'boxes'    => $firstClassItems,
            ];
        }

        // Sort services by lowest cost
        usort($services, function ($a, $b) {
            return $a['cost'] <=> $b['cost'];
        });

        // Limit to top 3 cheapest options
        $services = array_slice($services, 0, 3);

        $numSmallBoxes = $numSmallBoxesLight + $numSmallBoxesMedium + $numSmallBoxesHeavy;

        $debugString .= "{$totalWeight}|{$lightItems}>{$numSmallBoxes}|{$mediumItems}>{$numMediumBoxes}|{$heavyItems}>{$numLargeBoxes}|{$firstClassItems}--*--{$cart->items->count()}";

        $result = [];

        // Prepare rates as CartShippingRate objects
        foreach ($services as $service) {

            $boxesStr = $service['boxes'] == 1 ? " Box" : " Boxes";

            $cartShippingRate = new CartShippingRate;

            $cartShippingRate->carrier = $this->getCode();
            $cartShippingRate->carrier_title = $this->getConfigData('title') ?? 'USPS Flat Rate Shipping';
            $cartShippingRate->method = Str::slug($service['name'], '_');
            $cartShippingRate->method_title = $service['name'] . PHP_EOL . " (" . $service['boxes'] . $boxesStr . ")";
            $cartShippingRate->method_description = $service['delivery'];
            $cartShippingRate->price = $service['cost'];
            $cartShippingRate->base_price = $service['cost'];

            $result[] = $cartShippingRate;
        }

        return $result;
    }
}
