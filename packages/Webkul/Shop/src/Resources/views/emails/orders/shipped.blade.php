@component('shop::emails.layout')
    <div style="margin-bottom: 34px;">
        <span style="font-size: 22px;font-weight: 600;color: #121A26">
            @lang('shop::app.emails.orders.shipped.title')
        </span> <br>

        <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
            @lang('shop::app.emails.dear', ['customer_name' => $shipment->order->customer_full_name]),👋
        </p>

        <p style="font-size: 16px;color: #5E5E5E;line-height: 24px;">
            @lang('shop::app.emails.orders.shipped.greeting', [
                'invoice_id' => $shipment->increment_id,
                'order_id'   => '<a href="' . route('shop.customers.account.orders.view', $shipment->order_id) . '" style="color: #2969FF;">#' . $shipment->order->increment_id . '</a>',
                'created_at' => core()->formatDate($shipment->order->created_at, 'm/d/Y h:i:s A')
            ])
        </p>
    </div>

    <div style="font-size: 20px;font-weight: 600;color: #121A26">
        @lang('shop::app.emails.orders.shipped.summary')
    </div>

    @include ('shop::emails.orders.parts.order_address', ['order' => $shipment->order])
    @include ('shop::emails.orders.parts.payments', ['order' => $shipment->order])
    @include ('shop::emails.orders.parts.shipping', ['order' => $shipment->order, 'shipment' =>  $shipment])

    <br/>
    <br/>

    <div style="padding-bottom: 20px;border-bottom: 1px solid #CBD5E1;">
        <table style="overflow-x: auto; border-collapse: collapse;
        border-spacing: 0;width: 100%">
            <thead>
                <tr style="color: #121A26;border-top: 1px solid #CBD5E1;border-bottom: 1px solid #CBD5E1;">
                    <th style="text-align: left;padding: 5px">@lang('shop::app.emails.orders.sku')</th>
                    <th style="text-align: left;padding: 5px">@lang('shop::app.emails.orders.name')</th>
                    <th style="text-align: right;padding: 5px">@lang('shop::app.emails.orders.price')</th>
                    <th style="text-align: right;padding: 5px">@lang('shop::app.emails.orders.qty')</th>
                </tr>
            </thead>

            <tbody style="font-size: 16px;font-weight: 400;color: #384860;">
                @foreach ($shipment->items as $item)
                    <tr style="vertical-align: text-top;">
                        <td style="text-align: left;padding: 5px">
                            {{ $item->sku }}
                        </td>

                        <td style="text-align: left;padding: 5px">
                            {{ $item->name }}

                            @if (isset($item->additional['attributes']))
                                <div>

                                    @foreach ($item->additional['attributes'] as $attribute)
                                        <b>{{ $attribute['attribute_name'] }} : </b>{{ $attribute['option_label'] }}</br>
                                    @endforeach

                                </div>
                            @endif
                        </td>

                        <td style="display: flex;flex-direction: column;text-align: right;padding: 5px">
                            @if (core()->getConfigData('sales.taxes.sales.display_prices') == 'including_tax')
                                {{ core()->formatPrice($item->price_incl_tax, $shipment->order->order_currency_code) }}
                            @elseif (core()->getConfigData('sales.taxes.sales.display_prices') == 'both')
                                {{ core()->formatPrice($item->price_incl_tax, $shipment->order->order_currency_code) }}

                                <span style="font-size: 12px;">
                                    @lang('shop::app.emails.orders.excl-tax')

                                    <span style="font-weight: 600">
                                        {{ core()->formatPrice($item->price, $shipment->order->order_currency_code) }}
                                    </span>
                                </span>
                            @else
                                {{ core()->formatPrice($item->price, $shipment->order->order_currency_code) }}
                            @endif
                        </td>

                        <td style="text-align: right;padding: 5px">
                            {{ $item->qty }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endcomponent
