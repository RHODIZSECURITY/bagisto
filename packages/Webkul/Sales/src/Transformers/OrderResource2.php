<?php

namespace Webkul\Sales\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource2 extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $shippingInformation = [];

        if ($this->haveStockableItems()) {
            $shippingInformation = [
                'shipping_method'               => 'free',
                'shipping_title'                => '',
                'shipping_description'          => '',
                'shipping_amount'               => 0,
                'base_shipping_amount'          => 0,
                'shipping_amount_incl_tax'      => "0.0000",
                'base_shipping_amount_incl_tax' => "0.0000",
                'shipping_discount_amount'      => "0.0000",
                'base_shipping_discount_amount' => "0.0000",
                'shipping_address'              => [
                    "address_type" => "cart_shipping",
                    "first_name" => "Compra",
                    "last_name" => " en Tienda",
                    "gender" => null,
                    "company_name" => "Vaqueras ala Moda",
                    "address" => "834 Litle York RD",
                    "city" => "Houston",
                    "state" => "TX",
                    "country" => "US",
                    "postcode" => "77076",
                    "email" => "support@vaquerasalamoda.com",
                    "phone" => "12817639506",
                    "vat_id" => null
                  ],
            ];
        }

        return [
            'cart_id'                  => $this->id,
            'is_guest'                 => $this->is_guest,
            'customer_id'              => $this->customer_id,
            'customer_type'            => $this->customer ? get_class($this->customer) : null,
            'customer_email'           => $this->customer_email,
            'customer_first_name'      => $this->customer_first_name,
            'customer_last_name'       => $this->customer_last_name,
            'channel_id'               => $this->channel_id,
            'channel_name'             => $this->channel->name,
            'channel_type'             => get_class($this->channel),
            'total_item_count'         => $this->items_count,
            'total_qty_ordered'        => $this->items_qty,
            'base_currency_code'       => $this->base_currency_code,
            'channel_currency_code'    => $this->channel_currency_code,
            'order_currency_code'      => $this->cart_currency_code,
            'grand_total'              => $this->grand_total,
            'base_grand_total'         => $this->base_grand_total,
            'sub_total'                => $this->sub_total,
            'sub_total_incl_tax'       => $this->sub_total_incl_tax,
            'base_sub_total'           => $this->base_sub_total,
            'base_sub_total_incl_tax'  => $this->base_sub_total_incl_tax,
            'tax_amount'               => $this->tax_total,
            'base_tax_amount'          => $this->base_tax_total,
            'shipping_tax_amount'      => $this->selected_shipping_rate?->tax_amount ?? 0,
            'base_shipping_tax_amount' => $this->selected_shipping_rate?->base_tax_amount ?? 0,
            'coupon_code'              => $this->coupon_code,
            'applied_cart_rule_ids'    => $this->applied_cart_rule_ids,
            'discount_amount'          => $this->discount_amount,
            'base_discount_amount'     => $this->base_discount_amount,
            'billing_address'          => [
                "address_type" => "cart_billing",
                "first_name" => "Compra",
                "last_name" => " en Tienda",
                "gender" => null,
                "company_name" => "Vaqueras ala Moda",
                "address" => "834 Litle York RD",
                "city" => "Houston",
                "state" => "TX",
                "country" => "US",
                "postcode" => "77076",
                "email" => "support@vaquerasalamoda.com",
                "phone" => "12817639506",
                "vat_id" => null
              ],
             $this->mergeWhen($this->haveStockableItems(), $shippingInformation),
             'payment' => [
                "method" => "cashondelivery",
                "method_title" => "Cash",
                "additional" => null
              ],
             'items' => OrderItemResource::collection($this->items)->jsonSerialize(),
        ];
    }
}
