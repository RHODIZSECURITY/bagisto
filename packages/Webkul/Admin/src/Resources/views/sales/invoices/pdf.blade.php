<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html
    lang="{{ app()->getLocale() }}"
    dir="{{ core()->getCurrentLocale()->direction }}"
>
    <head>
        <!-- meta tags -->
        <meta
            http-equiv="Cache-control"
            content="no-cache"
        >

        <meta
            http-equiv="Content-Type"
            content="text/html; charset=utf-8"
        />

        @php
            $fontPath = [];

            // Get the default locale code.
            $getLocale = app()->getLocale();

            // Get the current curreny code.
            $currencyCode = core()->getBaseCurrencyCode();

            if ($getLocale == 'en' && $currencyCode == 'INR') {
                $fontFamily = [
                    'regular' => 'DejaVu Sans',
                    'bold'    => 'DejaVu Sans',
                ];
            }  else {
                $fontFamily = [
                    'regular' => 'Arial, sans-serif',
                    'bold'    => 'Arial, sans-serif',
                ];
            }


            if (in_array($getLocale, ['ar', 'he', 'fa', 'tr', 'ru', 'uk'])) {
                $fontFamily = [
                    'regular' => 'DejaVu Sans',
                    'bold'    => 'DejaVu Sans',
                ];
            } elseif ($getLocale == 'zh_CN') {
                $fontPath = [
                    'regular' => asset('fonts/NotoSansSC-Regular.ttf'),
                    'bold'    => asset('fonts/NotoSansSC-Bold.ttf'),
                ];
                
                $fontFamily = [
                    'regular' => 'Noto Sans SC',
                    'bold'    => 'Noto Sans SC Bold',
                ];
            } elseif ($getLocale == 'ja') {
                $fontPath = [
                    'regular' => asset('fonts/NotoSansJP-Regular.ttf'),
                    'bold'    => asset('fonts/NotoSansJP-Bold.ttf'),
                ];
                
                $fontFamily = [
                    'regular' => 'Noto Sans JP',
                    'bold'    => 'Noto Sans JP Bold',
                ];
            } elseif ($getLocale == 'hi_IN') {
                $fontPath = [
                    'regular' => asset('fonts/Hind-Regular.ttf'),
                    'bold'    => asset('fonts/Hind-Bold.ttf'),
                ];
                
                $fontFamily = [
                    'regular' => 'Hind',
                    'bold'    => 'Hind Bold',
                ];
            } elseif ($getLocale == 'bn') {
                $fontPath = [
                    'regular' => asset('fonts/NotoSansBengali-Regular.ttf'),
                    'bold'    => asset('fonts/NotoSansBengali-Bold.ttf'),
                ];
                
                $fontFamily = [
                    'regular' => 'Noto Sans Bengali',
                    'bold'    => 'Noto Sans Bengali Bold',
                ];
            } elseif ($getLocale == 'sin') {
                $fontPath = [
                    'regular' => asset('fonts/NotoSansSinhala-Regular.ttf'),
                    'bold'    => asset('fonts/NotoSansSinhala-Bold.ttf'),
                ];
                
                $fontFamily = [
                    'regular' => 'Noto Sans Sinhala',
                    'bold'    => 'Noto Sans Sinhala Bold',
                ];
            }
        @endphp

        <!-- lang supports inclusion -->
        <style type="text/css">
            @if (! empty($fontPath['regular']))
                @font-face {
                    src: url({{ $fontPath['regular'] }}) format('truetype');
                    font-family: {{ $fontFamily['regular'] }};
                }
            @endif
            
            @if (! empty($fontPath['bold']))
                @font-face {
                    src: url({{ $fontPath['bold'] }}) format('truetype');
                    font-family: {{ $fontFamily['bold'] }};
                    font-style: bold;
                }
            @endif
            
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: {{ $fontFamily['regular'] }};
            }

            body {
                font-size: 10px;
                color: #091341;
                font-family: "{{ $fontFamily['regular'] }}";
            }

            b, th {
                font-family: "{{ $fontFamily['bold'] }}";
            }

            .page-content {
                padding: 12px;
            }

            .page-header {
                border-bottom: 1px solid #E9EFFC;
                text-align: center;
                font-size: 24px;
                text-transform: uppercase;
                color: #000DBB;
                padding: 24px 0;
                margin: 0;
            }

            .logo-container {
                position: absolute;
                top: 20px;
                left: 20px;
            }

            .logo-container.rtl {
                left: auto;
                right: 20px;
            }

            .logo-container img {
                max-width: 100%;
                height: auto;
            }

            .page-header b {
                display: inline-block;
                vertical-align: middle;
            }

            .small-text {
                font-size: 7px;
            }

            table {
                width: 100%;
                border-spacing: 1px 0;
                border-collapse: separate;
                margin-bottom: 16px;
            }
            
            table thead th {
                background-color: #E9EFFC;
                color: #000DBB;
                padding: 6px 18px;
                text-align: left;
            }

            table.rtl thead tr th {
                text-align: right;
            }

            table tbody td {
                padding: 9px 18px;
                border-bottom: 1px solid #E9EFFC;
                text-align: left;
                vertical-align: top;
            }

            table.rtl tbody tr td {
                text-align: right;
            }

            .summary {
                width: 100%;
                display: inline-block;
            }

            .summary table {
                float: right;
                width: 250px;
                padding-top: 5px;
                padding-bottom: 5px;
                background-color: #E9EFFC;
                white-space: nowrap;
            }

            .summary table.rtl {
                width: 280px;
            }

            .summary table.rtl {
                margin-right: 480px;
            }

            .summary table td {
                padding: 5px 10px;
            }

            .summary table td:nth-child(2) {
                text-align: center;
            }

            .summary table td:nth-child(3) {
                text-align: right;
            }
        </style>
    </head>

    <body dir="{{ core()->getCurrentLocale()->direction }}">
        <div class="logo-container {{ core()->getCurrentLocale()->direction }}">
            @if (core()->getConfigData('sales.invoice_settings.pdf_print_outs.logo'))
                <img style="width: 131px; height: 42px" src="{{ Storage::url(core()->getConfigData('general.design.admin_logo.logo_image')) }}"/>
            @else
                <img style="width: 131px; height: 42px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAXMAAAB2CAMAAAAN3oOnAAAAAXNSR0IArs4c6QAAAwBQTFRFR3BMhX5+hHZ4OwAafW1we3BxVVVVc2VnfG5wamBgiX1+Z1hYdGhnf3F0XFBRb2RkcWRkqlVbUUVHbmNkX1VXUkhKRzs8YFNVeGtrVEhKdGlqaVpdaVxeV0lIb2NkT0JDQDAsOColRDY2OSosQjM1LyAfQDM2NiciTT4+JhgVWEtJJRYUMiUfOCsnLR4bSjw5RjYwSToxUEI6TT45Rz00QjowQDYsSkI3Ukc9PjIpTD4xNSkjQzIsSkU9RUA5QT01Oi0kKhwZQDMxRjczRzo2NTErOTUwLyggPzArKSQgJiAaHBgSIBwXMSwnFA4KCgYECAQCEAsHBAICCwkHCwsLCAgIBgYGDQ4NBQQGBAUGBQYDBQgFBgkICAoIAgQCAQABBQYKEREQFRUTDggEBQEDGhIMDgQCCgEBPTo2T0pEWk5DKSIhcmhhaGFbZFhOfnBkno9+jYN6tqaWvq6bu6mUw7KewaySybeixbCWsqKPu6SIo5eKq52PzbWYzsG3gnhuvrSpxquKya6Lw6iHzLGQy62UzLytj31os5t+squmf3t7qKKeFQkGFhITjoqM6trR5NTL2M3H8OLY28e75tDA6NPF7dbI4cy+7tLD8tvMl5COeHR2vLi6GhQTIgQD9Ma837mmuHVtfjEyOwgKXxcanU5Q8NzP287B4c/CS0VH18i7zr6tJxkbj4aFz7+xm5KLIhMUiIOEKh0dMycqRjw9VUtIgHt8gn1+enBxcWxtXVlaeXV2nZSRg3x+cGlqZFtZbmlp283E1Ma6z8G2vq+gva2ckoyN0sO1wrWrzcG4w7ast6igv7Gnuq6loZaQnZOPua2ltqidsaKYs6mhrJyRsKKZsKOXbWVnZFhXlImIrKGaVEdEqZ+YZVpbmpCNu66myL2xqpyVmI6Omo+PlYiHfHJ0oJaSnY+PrqGaiX1+sKOcrKCZg3Z4iHp5hnp7t6qjraCZwbSsjH+BnI6PvK+omo2MqZ6ak4iIsKWfrqKfqKCeiXZ8hXh7tLOusKei////Sdx5NwAAAQB0Uk5TAAIHAQkFAxAUGBohKiMsMkUDQTpPNmFhUppteIuEXXLDzoSunLlN2qnIsdHo8d62///////////////3/v/////r9Nn4////5v/////////////////////////////////////////////2/////////v////////z////////+///////+/////f3X+vn///////////////7F9/H//////////69y3fe95pOvzpih5YRv7uHOuq/x9t3jmtjXvEaMp9Px0GR3PFrHoZO1o7Ps5XrKo7icvorYyZSuflAqh29jWIZNPG5vQl5eSjs0KhgxKCAeFxQQCwgEDQMFAa9n/SQAADitSURBVHja7JrbbxzVAcZ9SZrEkNqAHYgpSVARCGjVUohJEFALCK7X9s7MmXOZmZ2d2dlrstr77Fw864mzO5vYcar8AUmF8toHHtJCAnHi+ImXPiAKUpRI0FZR2lq4KXVwbMd20rOmVAQIJKEPqNnf7IxGq71IP337zTlntuE2aG5uXFq7vrXtgemps6eOvzX5H14/dWpqU3tHx11rlhYb6tyYxlsWvtR0uWPN6veW3t/y1+Xmmtzf+/9512zDPQ3XGhpWNzZsXP3n4PLV2Znmhsa63f8Ny3N339t56vix8bdP/Db5wkC/UEOkeygEBNK7c9eJ1NjE6ckLD7S2LDXXdX13mpvm7ut8d2JiLJ/a6UuwIBoSIeIRxECEAhFgSBRw1O/fkX779Om3Ptr0w3VX6tq/G4tLs+1ThycO5jO9gGUZlsEhSARAPSMe8gJRESEQhgTEMJpv54nx0x92trWsWq6Lu22aGy9t+svEeCr1qoBUiUMKghDSRgkRiBDPMbwfCCsVI2iQAIb192dOnJ6cal/fVO/126SxpePsxMmxF1giIlGQGAI1TaHCCRJViYkyTIJheJrymnQgShLhgcrsSE1MXri3ZbFu/TZommudOjae3aXR2hCQCJEUCChBlRCBYBAeGOiNReIJluFrzjUBQjkYBLKkIn4gPTE51bqmXuu3yuLyTOfrRw/uDAOBwBCEIg5IAUmWMFYRBOHMcD6ffqYnEYkwHI9EWHOOJTFAT8KC0Pv2xLub1jXXa/2WaLp839nxg2lCXROkKmEYokqlAJAIQDzLDAwPF3brhVxXd78/zjEsABjJRIaqRlSMQggOHDx8oaOlqS7yFpTPTB8/OubDAFOLRJFFWQ7AWreA8I5tXdt9EX88qe8rGnpueNuAL8at9Lqi1q6lQEMAYIBS45PTHdfqKm+S1Y0Xzx47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"/>
            @endif
        </div>

        <div class="page">
            <!-- Header -->
            <div class="page-header">
                <b>@lang('admin::app.sales.invoices.invoice-pdf.invoice')</b>
            </div>

            <div class="page-content">
                <!-- Invoice Information -->
                <table class="{{ core()->getCurrentLocale()->direction }}">
                    <tbody>
                        <tr>
                            @if (core()->getConfigData('sales.invoice_settings.pdf_print_outs.invoice_id'))
                                <td style="width: 50%; padding: 2px 18px;border:none;">
                                    <b>
                                        @lang('admin::app.sales.invoices.invoice-pdf.invoice-id'):
                                    </b>

                                    <span>
                                        #{{ $invoice->increment_id ?? $invoice->id }}
                                    </span>
                                </td>
                            @endif

                            @if (core()->getConfigData('sales.invoice_settings.pdf_print_outs.order_id'))
                                <td style="width: 50%; padding: 2px 18px;border:none;">
                                    <b>
                                        @lang('admin::app.sales.invoices.invoice-pdf.order-id'): 
                                    </b>

                                    <span>
                                        #{{ $invoice->order->increment_id }}
                                    </span>
                                </td>
                            @endif
                        </tr>
                        
                        <tr>
                            <td style="width: 50%; padding: 2px 18px;border:none;">
                                <b>
                                    @lang('admin::app.sales.invoices.invoice-pdf.date'):
                                </b>

                                <span>
                                    {{ core()->formatDate($invoice->created_at, 'd-m-Y') }}
                                </span>
                            </td>

                            <td style="width: 50%; padding: 2px 18px;border:none;">
                                <b>
                                    @lang('admin::app.sales.invoices.invoice-pdf.order-date'):
                                </b>

                                <span>
                                    {{ core()->formatDate($invoice->order->created_at, 'd-m-Y') }}
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <!-- Invoice Information -->
                <table class="{{ core()->getCurrentLocale()->direction }}">
                    <tbody>
                        <tr>
                            @if (! empty(core()->getConfigData('sales.shipping.origin.country')))
                                <td style="width: 50%; padding: 2px 18px;border:none;">
                                    <b style="display: inline-block; margin-bottom: 4px;">
                                        {{ core()->getConfigData('sales.shipping.origin.store_name') }}
                                    </b>

                                    <div>
                                        <div>{{ core()->getConfigData('sales.shipping.origin.address') }}</div>

                                        <div>{{ core()->getConfigData('sales.shipping.origin.zipcode') . ' ' . core()->getConfigData('sales.shipping.origin.city') }}</div>

                                        <div>{{ core()->getConfigData('sales.shipping.origin.state') . ', ' . core()->getConfigData('sales.shipping.origin.country') }}</div>
                                    </div>
                                </td>
                            @endif

                            <td style="width: 50%; padding: 2px 18px;border:none;">
                                @if ($invoice->hasPaymentTerm())
                                    <div style="margin-bottom: 12px">
                                        <b style="display: inline-block; margin-bottom: 4px;">
                                            @lang('admin::app.sales.invoices.invoice-pdf.payment-terms'):
                                        </b>

                                        <span>
                                            {{ $invoice->getFormattedPaymentTerm() }}
                                        </span>
                                    </div>
                                @endif

                                @if (core()->getConfigData('sales.shipping.origin.bank_details'))
                                    <div>
                                        <b style="display: inline-block; margin-bottom: 4px;">
                                            @lang('admin::app.sales.invoices.invoice-pdf.bank-details'):
                                        </b>

                                        <div>
                                            {!! nl2br(core()->getConfigData('sales.shipping.origin.bank_details')) !!}
                                        </div>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Billing & Shipping Address -->
                <table class="{{ core()->getCurrentLocale()->direction }}">
                    <thead>
                        <tr>
                            @if ($invoice->order->billing_address)
                                <th style="width: 50%;">
                                    <b>
                                        @lang('admin::app.sales.invoices.invoice-pdf.bill-to')
                                    </b>
                                </th>
                            @endif

                            @if ($invoice->order->shipping_address)
                                <th style="width: 50%">
                                    <b>
                                        @lang('admin::app.sales.invoices.invoice-pdf.ship-to')
                                    </b>
                                </th>
                            @endif
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            @if ($invoice->order->billing_address)
                                <td style="width: 50%">
                                    <div>{{ $invoice->order->billing_address->company_name ?? '' }}<div>

                                    <div>{{ $invoice->order->billing_address->name }}</div>

                                    <div>{{ $invoice->order->billing_address->address }}</div>

                                    <div>{{ $invoice->order->billing_address->postcode . ' ' . $invoice->order->billing_address->city }}</div>

                                    <div>{{ $invoice->order->billing_address->state . ', ' . core()->country_name($invoice->order->billing_address->country) }}</div>

                                    <div>@lang('admin::app.sales.invoices.invoice-pdf.contact'): {{ $invoice->order->billing_address->phone }}</div>
                                </td>
                            @endif
                            
                            @if ($invoice->order->shipping_address)
                                <td style="width: 50%">
                                    <div>{{ $invoice->order->shipping_address->company_name ?? '' }}<div>

                                    <div>{{ $invoice->order->shipping_address->name }}</div>

                                    <div>{{ $invoice->order->shipping_address->address }}</div>

                                    <div>{{ $invoice->order->shipping_address->postcode . ' ' . $invoice->order->shipping_address->city }}</div>

                                    <div>{{ $invoice->order->shipping_address->state . ', ' . core()->country_name($invoice->order->shipping_address->country) }}</div>

                                    <div>@lang('admin::app.sales.invoices.invoice-pdf.contact'): {{ $invoice->order->shipping_address->phone }}</div>
                                </td>
                            @endif
                        </tr>
                    </tbody>
                </table>

                <!-- Payment & Shipping Methods -->
                <table class="{{ core()->getCurrentLocale()->direction }}">
                    <thead>
                        <tr>
                            <th style="width: 50%">
                                <b>
                                    @lang('admin::app.sales.invoices.invoice-pdf.payment-method')
                                </b>
                            </th>

                            @if ($invoice->order->shipping_address)
                                <th style="width: 50%">
                                    <b>
                                        @lang('admin::app.sales.invoices.invoice-pdf.shipping-method')
                                    </b>
                                </th>
                            @endif
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td style="width: 50%">
                                {{ core()->getConfigData('sales.payment_methods.' . $invoice->order->payment->method . '.title') }}

                                @php $additionalDetails = \Webkul\Payment\Payment::getAdditionalDetails($invoice->order->payment->method); @endphp

                                @if (! empty($additionalDetails))
                                    <div class="row small-text">
                                        <span>{{ $additionalDetails['title'] }}:</span>
                                        
                                        <span>{{ $additionalDetails['value'] }}</span>
                                    </div>
                                @endif
                            </td>

                            @if ($invoice->order->shipping_address)
                                <td style="width: 50%">
                                    {{ $invoice->order->shipping_title }}
                                </td>
                            @endif
                        </tr>
                    </tbody>
                </table>

                <!-- Items -->
                <div class="items">
                    <table class="{{ core()->getCurrentLocale()->direction }}">
                        <thead>
                            <tr>
                                <th>
                                    @lang('admin::app.sales.invoices.invoice-pdf.sku')
                                </th>

                                <th>
                                    @lang('admin::app.sales.invoices.invoice-pdf.product-name')
                                </th>

                                <th>
                                    @lang('admin::app.sales.invoices.invoice-pdf.price')
                                </th>

                                <th>
                                    @lang('admin::app.sales.invoices.invoice-pdf.qty')
                                </th>

                                <th>
                                    @lang('admin::app.sales.invoices.invoice-pdf.subtotal')
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($invoice->items as $item)
                                <tr>
                                    <td>
                                        {{ $item->getTypeInstance()->getOrderedItem($item)->sku }}
                                    </td>

                                    <td>
                                        {{ $item->name }}

                                        @if (isset($item->additional['attributes']))
                                            <div>
                                                @foreach ($item->additional['attributes'] as $attribute)
                                                    <b>{{ $attribute['attribute_name'] }} : </b>{{ $attribute['option_label'] }}</br>
                                                @endforeach
                                            </div>
                                        @endif
                                    </td>

                                    <td>
                                        @if (core()->getConfigData('sales.taxes.sales.display_prices') == 'including_tax')
                                            {!! core()->formatBasePrice($item->base_price_incl_tax, true) !!}
                                        @elseif (core()->getConfigData('sales.taxes.sales.display_prices') == 'both')
                                            {!! core()->formatBasePrice($item->base_price_incl_tax, true) !!}
                                            
                                            <div class="small-text">
                                                @lang('admin::app.sales.invoices.invoice-pdf.excl-tax')
                                                
                                                <span>
                                                    {{ core()->formatPrice($item->base_price) }}
                                                </span>
                                            </div>
                                        @else
                                            {!! core()->formatBasePrice($item->base_price, true) !!}
                                        @endif
                                    </td>

                                    <td>
                                        {{ $item->qty }}
                                    </td>

                                    <td>
                                        @if (core()->getConfigData('sales.taxes.sales.display_subtotal') == 'including_tax')
                                            {!! core()->formatBasePrice($item->base_total_incl_tax, true) !!}
                                        @elseif (core()->getConfigData('sales.taxes.sales.display_subtotal') == 'both')
                                            {!! core()->formatBasePrice($item->base_total_incl_tax, true) !!}
                                            
                                            <div class="small-text">
                                                @lang('admin::app.sales.invoices.invoice-pdf.excl-tax')
                                                
                                                <span>
                                                    {{ core()->formatPrice($item->base_total) }}
                                                </span>
                                            </div>
                                        @else
                                            {!! core()->formatBasePrice($item->base_total, true) !!}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Summary Table -->
                <div class="summary">
                    <table class="{{ core()->getCurrentLocale()->direction }}">
                        <tbody>
                            @if (core()->getConfigData('sales.taxes.sales.display_subtotal') == 'including_tax')
                                <tr>
                                    <td>@lang('admin::app.sales.invoices.invoice-pdf.subtotal')</td>
                                    <td>-</td>
                                    <td>{!! core()->formatBasePrice($invoice->base_sub_total_incl_tax, true) !!}</td>
                                </tr>
                            @elseif (core()->getConfigData('sales.taxes.sales.display_subtotal') == 'both')
                                <tr>
                                    <td>@lang('admin::app.sales.invoices.invoice-pdf.subtotal-incl-tax')</td>
                                    <td>-</td>
                                    <td>{!! core()->formatBasePrice($invoice->base_sub_total_incl_tax, true) !!}</td>
                                </tr>
                                
                                <tr>
                                    <td>@lang('admin::app.sales.invoices.invoice-pdf.subtotal-excl-tax')</td>
                                    <td>-</td>
                                    <td>{!! core()->formatBasePrice($invoice->base_sub_total, true) !!}</td>
                                </tr>
                            @else
                                <tr>
                                    <td>@lang('admin::app.sales.invoices.invoice-pdf.subtotal')</td>
                                    <td>-</td>
                                    <td>{!! core()->formatBasePrice($invoice->base_sub_total, true) !!}</td>
                                </tr>
                            @endif

                            @if (core()->getConfigData('sales.taxes.sales.display_shipping_amount') == 'including_tax')
                                <tr>
                                    <td>@lang('admin::app.sales.invoices.invoice-pdf.shipping-handling')</td>
                                    <td>-</td>
                                    <td>{!! core()->formatBasePrice($invoice->base_shipping_amount_incl_tax, true) !!}</td>
                                </tr>
                            @elseif (core()->getConfigData('sales.taxes.sales.display_shipping_amount') == 'both')
                                <tr>
                                    <td>@lang('admin::app.sales.invoices.invoice-pdf.shipping-handling-incl-tax')</td>
                                    <td>-</td>
                                    <td>{!! core()->formatBasePrice($invoice->base_shipping_amount_incl_tax, true) !!}</td>
                                </tr>
                                
                                <tr>
                                    <td>@lang('admin::app.sales.invoices.invoice-pdf.shipping-handling-excl-tax')</td>
                                    <td>-</td>
                                    <td>{!! core()->formatBasePrice($invoice->base_shipping_amount, true) !!}</td>
                                </tr>
                            @else
                                <tr>
                                    <td>@lang('admin::app.sales.invoices.invoice-pdf.shipping-handling')</td>
                                    <td>-</td>
                                    <td>{!! core()->formatBasePrice($invoice->base_shipping_amount, true) !!}</td>
                                </tr>
                            @endif

                            <tr>
                                <td>@lang('admin::app.sales.invoices.invoice-pdf.tax')</td>
                                <td>-</td>
                                <td>{!! core()->formatBasePrice($invoice->base_tax_amount, true) !!}</td>
                            </tr>

                            <tr>
                                <td>@lang('admin::app.sales.invoices.invoice-pdf.discount')</td>
                                <td>-</td>
                                <td>{!! core()->formatBasePrice($invoice->base_discount_amount, true) !!}</td>
                            </tr>

                            <tr>
                                <td style="border-top: 1px solid #FFFFFF;">
                                    <b>@lang('admin::app.sales.invoices.invoice-pdf.grand-total')</b>
                                </td>
                                <td style="border-top: 1px solid #FFFFFF;">-</td>
                                <td style="border-top: 1px solid #FFFFFF;">
                                    <b>{!! core()->formatBasePrice($invoice->base_grand_total, true) !!}</b>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Footer Content -->
                @if (core()->getConfigData('sales.invoice_settings.pdf_print_outs.footer_text'))
                    <div>
                        {{ core()->getConfigData('sales.invoice_settings.pdf_print_outs.footer_text') }}
                    </div>
                @endif
            </div>
        </div>
    </body>
</html>
