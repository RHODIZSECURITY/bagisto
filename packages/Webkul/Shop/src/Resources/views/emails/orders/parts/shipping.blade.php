<div style="font-size: 16px;font-weight: 600;color: #121A26; margin-top: 20px;">
    @lang('admin::app.emails.orders.shipping')
</div>

<div style="font-size: 16px;font-weight: 400;color: #384860; margin-top: 10px;">
    {{ $order->shipping_title }}
</div>

@if ($shipment)
    <div style="font-size: 16px; color: #384860;">
        <div style="margin-top: 10px;">
            <span>@lang('admin::app.emails.orders.carrier') : </span>
            {{ $shipment->carrier_title }}
        </div>

        <div style="margin-top: 10px;">
            <span>@lang('admin::app.emails.orders.tracking-number', [ 'tracking_number' => '' ] )</span>
            <span>
                <a href="https://tools.usps.com/go/TrackConfirmAction?tRef=fullpage&tLc=2&text28777=&tLabels={{ $shipment->track_number }}%2C#" target="_blank" style="color: #0000FF; text-decoration: underline;" >{{ $shipment->track_number }}</a>
            </span>
        </div>
    </div>
@endif
