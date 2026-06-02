@php
    use App\Models\GeneralSetting;
    use App\Models\OrderDetail;
    use App\Models\Product;
    use App\Models\ProductVariation;

    $generalSetting = $generalSetting ?? GeneralSetting::find(1);
    $siteName = data_get($generalSetting, 'site_name') ?: config('app.name', 'Saniruddh');
    $siteMail = data_get($generalSetting, 'site_mail');
    $sitePhone = data_get($generalSetting, 'site_phone');
    $siteUrl = data_get($generalSetting, 'site_url');
    $logoFile = trim((string) data_get($generalSetting, 'site_logo'));
    $logoPath = $logoFile !== '' ? public_path('uploads/'.$logoFile) : '';
    $fallbackLogoPath = public_path('frontend/images/logo/logo.png');
    $resolvedLogoPath = is_file($logoPath) ? $logoPath : $fallbackLogoPath;
    $logoSrc = asset('public/frontend/images/logo/logo.png');

    if (is_file($resolvedLogoPath)) {
        $logoMime = mime_content_type($resolvedLogoPath) ?: 'image/png';
        $logoSrc = 'data:'.$logoMime.';base64,'.base64_encode(file_get_contents($resolvedLogoPath));
    }

    $orderDetails = OrderDetail::where('order_id', '=', $getOrderDetail->id)->get();
    $products = Product::whereIn('id', $orderDetails->pluck('product_id'))->get()->keyBy('id');
    $variationSkus = ProductVariation::whereIn('id', $orderDetails->pluck('variation_id')->filter())->pluck('sku', 'id');
    $orderDate = trim(
        ($getOrderDetail->order_date ? date('d M Y', strtotime($getOrderDetail->order_date)) : '')
        .' '
        .($getOrderDetail->order_time ? date('h:i A', strtotime($getOrderDetail->order_time)) : '')
    );
    $paymentLabel = (int) $getOrderDetail->payment_status === 1
        ? 'Paid'
        : ($getOrderDetail->payment_mode === 'COD' ? 'Cash on delivery' : 'Pending');
@endphp
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ $siteName }} Invoice {{ $getOrderDetail->order_no }}</title>
    <style>
        * { box-sizing: border-box; }
        body { color: #443b35; font-family: DejaVu Sans, sans-serif; font-size: 11px; line-height: 1.55; margin: 0; padding: 0; }
        table { border-collapse: collapse; width: 100%; }
        .page { padding: 22px; }
        .brand-bar { background: #6f2634; height: 7px; }
        .header { border-bottom: 1px solid #e5d7c4; padding: 20px 0 18px; }
        .logo { max-height: 68px; max-width: 220px; }
        .invoice-label { color: #9b6a38; font-size: 10px; font-weight: bold; letter-spacing: 2px; text-transform: uppercase; }
        .invoice-number { color: #382f2b; font-family: DejaVu Serif, serif; font-size: 22px; margin-top: 6px; }
        .meta { color: #75675b; font-size: 10px; margin-top: 5px; }
        .section-title { color: #6f2634; font-family: DejaVu Serif, serif; font-size: 15px; margin: 0 0 8px; }
        .address-grid { margin: 20px 0; }
        .address-card { background: #fffaf3; border: 1px solid #eadfce; line-height: 1.65; padding: 13px; vertical-align: top; width: 49%; }
        .address-space { width: 2%; }
        .eyebrow { color: #9b6a38; font-size: 9px; font-weight: bold; letter-spacing: 1.3px; margin-bottom: 5px; text-transform: uppercase; }
        .items th { background: #6f2634; color: #ffffff; font-size: 9px; letter-spacing: .7px; padding: 9px 8px; text-align: left; text-transform: uppercase; }
        .items td { border-bottom: 1px solid #eee4d7; padding: 10px 8px; vertical-align: top; }
        .items .right, .totals .right { text-align: right; }
        .product-name { color: #382f2b; font-weight: bold; }
        .muted { color: #806f62; font-size: 10px; }
        .summary { margin-top: 14px; }
        .notes { color: #75675b; font-size: 10px; line-height: 1.65; padding-right: 18px; vertical-align: top; width: 56%; }
        .totals { background: #fffaf3; border: 1px solid #eadfce; width: 44%; }
        .totals td { padding: 6px 9px; }
        .totals .grand td { border-top: 1px solid #d9c5aa; color: #6f2634; font-size: 13px; font-weight: bold; padding-top: 9px; }
        .footer { border-top: 1px solid #eadfce; color: #806f62; font-size: 10px; margin-top: 24px; padding-top: 13px; text-align: center; }
    </style>
</head>
<body>
    <div class="brand-bar"></div>
    <div class="page">
        <table class="header">
            <tr>
                <td>
                    <img class="logo" src="{{ $logoSrc }}" alt="{{ $siteName }}">
                </td>
                <td style="text-align:right;">
                    <div class="invoice-label">Tax invoice</div>
                    <div class="invoice-number">{{ $getOrderDetail->order_no }}</div>
                    <div class="meta">{{ $orderDate }}</div>
                </td>
            </tr>
        </table>

        <table class="address-grid">
            <tr>
                <td class="address-card">
                    <div class="eyebrow">Bill to</div>
                    <strong>{{ trim($getOrderDetail->b_fname.' '.$getOrderDetail->b_lname) }}</strong><br>
                    {{ $getOrderDetail->b_street }}<br>
                    {{ $getOrderDetail->b_suburb }}, {{ $getOrderDetail->b_state }} {{ $getOrderDetail->b_postcode }}<br>
                    {{ $getOrderDetail->b_country }}<br>
                    {{ $getOrderDetail->b_phone }}<br>
                    {{ $getOrderDetail->b_email }}
                </td>
                <td class="address-space"></td>
                <td class="address-card">
                    <div class="eyebrow">Ship to</div>
                    <strong>{{ trim($getOrderDetail->s_fname.' '.$getOrderDetail->s_lname) }}</strong><br>
                    {{ $getOrderDetail->s_street }}<br>
                    {{ $getOrderDetail->s_suburb }}, {{ $getOrderDetail->s_state }} {{ $getOrderDetail->s_postcode }}<br>
                    {{ $getOrderDetail->s_country }}<br>
                    {{ $getOrderDetail->s_phone }}<br>
                    {{ $getOrderDetail->s_email }}
                </td>
            </tr>
        </table>

        <h2 class="section-title">Order details</h2>
        <table class="items">
            <thead>
                <tr>
                    <th style="width:36%;">Product</th>
                    <th style="width:23%;">Variation</th>
                    <th style="width:16%;">SKU</th>
                    <th class="right" style="width:10%;">Qty</th>
                    <th class="right" style="width:15%;">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orderDetails as $orderDetail)
                    @php
                        $product = $products->get($orderDetail->product_id);
                        $variationNames = collect(json_decode($orderDetail->parent_id_val, true) ?: []);
                        $variationValues = collect(json_decode($orderDetail->child_id_val, true) ?: []);
                        $variationText = $variationNames->map(function ($name, $index) use ($variationValues) {
                            $value = trim((string) $variationValues->get($index));
                            return $value !== '' ? trim((string) $name).': '.$value : '';
                        })->filter()->implode(', ');
                        $variationText = $variationText ?: ($orderDetail->variation_name ?: 'Standard');
                        $sku = $variationSkus->get($orderDetail->variation_id) ?: data_get($product, 'product_sku', 'N/A');
                        $lineAmount = (float) ($orderDetail->subtotal ?? $orderDetail->total);
                    @endphp
                    <tr>
                        <td>
                            <span class="product-name">{{ data_get($product, 'name', 'Product') }}</span>
                        </td>
                        <td class="muted">{{ $variationText }}</td>
                        <td class="muted">{{ $sku ?: 'N/A' }}</td>
                        <td class="right">{{ $orderDetail->qty }}</td>
                        <td class="right">&#8377; {{ number_format($lineAmount, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <table class="summary">
            <tr>
                <td class="notes">
                    <div class="eyebrow">Payment</div>
                    {{ $getOrderDetail->payment_mode ?: 'Pending' }} &middot; {{ $paymentLabel }}
                    @if(!empty($getOrderDetail->payment_txn_no))
                        <br>Transaction: {{ $getOrderDetail->payment_txn_no }}
                    @endif
                    @if(!empty($getOrderDetail->tracking_number))
                        <br>Tracking: {{ $getOrderDetail->tracking_number }}
                    @endif
                </td>
                <td>
                    <table class="totals">
                        <tr><td>Subtotal</td><td class="right">&#8377; {{ number_format((float) $getOrderDetail->subtotal, 2) }}</td></tr>
                        <tr><td>Discount</td><td class="right">- &#8377; {{ number_format((float) $getOrderDetail->disc_amount, 2) }}</td></tr>
                        <tr><td>Shipping</td><td class="right">&#8377; {{ number_format((float) $getOrderDetail->shipping_amt, 2) }}</td></tr>
                        <tr><td>Tax</td><td class="right">&#8377; {{ number_format((float) $getOrderDetail->tax_amt, 2) }}</td></tr>
                        <tr class="grand"><td>Total</td><td class="right">&#8377; {{ number_format((float) $getOrderDetail->net_amt, 2) }}</td></tr>
                    </table>
                </td>
            </tr>
        </table>

        <div class="footer">
            <strong>{{ $siteName }}</strong><br>
            {{ $siteMail }}@if($siteMail && $sitePhone) &nbsp;|&nbsp; @endif{{ $sitePhone }}@if(($siteMail || $sitePhone) && $siteUrl) &nbsp;|&nbsp; @endif{{ $siteUrl }}
            <br>Thank you for shopping with us.
        </div>
    </div>
</body>
</html>
