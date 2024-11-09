    @if ($order->shipping_address)
        <div style="line-height: 25px; margin-top: 20px;">
            <div style="font-size: 16px;font-weight: 600;color: #121A26;">
                @lang('admin::app.emails.orders.shipping-address')
            </div>

            <div style="font-size: 16px;font-weight: 400;color: #384860; margin-bottom: 10px;">
                {!! optional($order->shipping_address)->company_name ? optional($order->shipping_address)->company_name . '<br/>' : '' !!}

                {{ $order->shipping_address->name }}<br/>

                {{ $order->shipping_address->address }}, {{ $order->shipping_address->city }}, {{ $order->shipping_address->state }}, {{ $order->shipping_address->postcode }}<br/>

                @lang('admin::app.emails.orders.contact') : {{ $order->shipping_address->phone }}
            </div>
        </div>
    @endif

    @if ($order->billing_address)
        <div style="line-height: 25px; margin-top: 20px;">
            <div style="font-size: 16px;font-weight: 600;color: #121A26;">
                @lang('admin::app.emails.orders.billing-address')
            </div>

            <div style="font-size: 16px;font-weight: 400;color: #384860;    ">
                {!! optional($order->billing_address)->company_name ? optional($order->billing_address)->company_name . '<br/>' : '' !!}

                {{ $order->billing_address->name }}<br/>

                {{ $order->billing_address->address }}, {{ $order->billing_address->city }}, {{ $order->billing_address->state }}, {{ $order->billing_address->postcode }}<br/>

                @lang('admin::app.emails.orders.contact') : {{ $order->billing_address->phone }}
            </div>
        </div>
    @endif
