<div style="font-size: 16px;font-weight: 600;color: #121A26;  margin-top: 20px;">
    @lang('admin::app.emails.orders.payment')
</div>

<div style="font-size: 16px;font-weight: 400;color: #384860;  margin-top: 10px;">
    {{ core()->getConfigData('sales.payment_methods.' . $order->payment->method . '.title') }}
</div>

@php $additionalDetails = \Webkul\Payment\Payment::getAdditionalDetails($order->payment->method); @endphp

@if (! empty($additionalDetails))
    <div style="font-size: 16px; color: #384860; margin-top: 10px;">
        <div>{{ $additionalDetails['title'] }}</div>
        <div>{{ $additionalDetails['value'] }}</div>
    </div>
@endif
