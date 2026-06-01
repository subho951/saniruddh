<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $getOrderDetail->order_no }}</title>
    <style>body{font-family:Arial,sans-serif;color:#222;margin:30px}table{border-collapse:collapse;width:100%}th,td{border:1px solid #ddd;padding:10px;text-align:left}.right{text-align:right}.muted{color:#666}.actions{margin-bottom:20px}@media print{.actions{display:none}}</style>
</head>
<body>
    <div class="actions"><button onclick="window.print()">Print Invoice</button></div>
    <h1>Invoice</h1><p class="muted">{{ $getOrderDetail->order_no }} | {{ date('d M, Y', strtotime($getOrderDetail->order_date)) }}</p>
    <table><tr><td><strong>Bill To</strong><br>{{ $getOrderDetail->b_fname }} {{ $getOrderDetail->b_lname }}<br>{{ $getOrderDetail->b_street }}, {{ $getOrderDetail->b_suburb }}<br>{{ $getOrderDetail->b_state }} {{ $getOrderDetail->b_postcode }}, {{ $getOrderDetail->b_country }}</td><td><strong>Ship To</strong><br>{{ $getOrderDetail->s_fname }} {{ $getOrderDetail->s_lname }}<br>{{ $getOrderDetail->s_street }}, {{ $getOrderDetail->s_suburb }}<br>{{ $getOrderDetail->s_state }} {{ $getOrderDetail->s_postcode }}, {{ $getOrderDetail->s_country }}</td></tr></table>
    <h2>Items</h2>
    <table><thead><tr><th>Product</th><th>Variation</th><th>Quantity</th><th class="right">Amount</th></tr></thead><tbody>@foreach($invoiceItems as $item) @php($invoiceProduct = $invoiceProducts->get($item->product_id))<tr><td>{{ $invoiceProduct->name ?? 'Product' }}</td><td>{{ $item->variation_name }}</td><td>{{ $item->qty }}</td><td class="right">{{ number_format($item->subtotal, 2) }}</td></tr>@endforeach</tbody><tfoot><tr><td colspan="3" class="right">Subtotal</td><td class="right">{{ number_format($getOrderDetail->subtotal, 2) }}</td></tr><tr><td colspan="3" class="right">Shipping</td><td class="right">{{ number_format($getOrderDetail->shipping_amt, 2) }}</td></tr><tr><td colspan="3" class="right">Tax</td><td class="right">{{ number_format($getOrderDetail->tax_amt, 2) }}</td></tr><tr><td colspan="3" class="right"><strong>Total</strong></td><td class="right"><strong>{{ number_format($getOrderDetail->net_amt, 2) }}</strong></td></tr></tfoot></table>
    <p><strong>Payment method:</strong> {{ $getOrderDetail->payment_mode }}</p>
</body>
</html>
