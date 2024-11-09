<div style="padding-bottom: 40px;border-bottom: 1px solid #CBD5E1;">
    <table style="overflow-x: auto; border-collapse: collapse;
    border-spacing: 0;width: 100%; margin: 0px;">
        <thead>
            <tr style="color: #121A26;border-top: 1px solid #CBD5E1;border-bottom: 1px solid #CBD5E1; margin: 0px;">
                @foreach (['sku', 'name', 'price', 'qty'] as $item)
                    <th style="text-align: left; margin: 0px; padding: 15px; padding-left: 4px;padding-rigth: 4px">
                        @lang('admin::app.emails.orders.' . $item)
                    </th>
                @endforeach
            </tr>
        </thead>

        <tbody style="font-size: 16px;font-weight: 400;color: #384860;">
            @foreach ($order->items as $item)
                <tr style="vertical-align: text-top;">
                    <td style="text-align: left; padding: 15px; padding-left: 4px; padding-rigth: 4px">
                        {{ $item->getTypeInstance()->getOrderedItem($item)->sku }}
                    </td>

                    <td style="text-align: left; padding: 15px; padding-left: 4px; padding-rigth: 4px">
                        {{ $item->name }}

                        @if (isset($item->additional['attributes']))
                            <div>

                                @foreach ($item->additional['attributes'] as $attribute)
                                    <b>{{ $attribute['attribute_name'] }} : </b>{{ $attribute['option_label'] }}</br>
                                @endforeach

                            </div>
                        @endif
                    </td>

                    <td style="display: flex;flex-direction: column;text-align: left; padding: 10px; padding-left: 4px;padding-rigth: 4px">
                        @if (core()->getConfigData('sales.taxes.sales.display_prices') == 'including_tax')
                            {{ core()->formatBasePrice($item->base_price_incl_tax) }}
                        @elseif (core()->getConfigData('sales.taxes.sales.display_prices') == 'both')
                            {{ core()->formatBasePrice($item->base_price_incl_tax) }}

                            <span style="font-size: 12px; white-space: nowrap">
                                @lang('admin::app.emails.orders.excl-tax')

                                <span style="font-weight: 600">
                                    {{ core()->formatBasePrice($item->base_price) }}
                                </span>
                            </span>
                        @else
                            {{ core()->formatBasePrice($item->base_price) }}
                        @endif
                    </td>

                    <td style="text-align: left; padding: 15px; padding-left: 4px;padding-rigth: 4px">
                        {{ $item->qty_canceled }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
