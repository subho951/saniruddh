<div class="account-table table-responsive">
    <table class="table">
        <thead><tr><th>Order</th><th>Date</th><th>Total</th><th>Payment</th><th>Status</th><th></th></tr></thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>{{ $order->order_no }}</td>
                    <td>{{ date('d M, Y', strtotime($order->order_date)) }}</td>
                    <td><i class="fa fa-inr"></i> {{ number_format($order->net_amt, 2) }}</td>
                    <td>{{ $order->payment_mode ?: 'Pending' }}</td>
                    <td>{{ $orderStatusLabels[$order->status] ?? 'Processing' }}</td>
                    <td><a href="{{ url('user/order-details/'.\App\Helpers\Helper::encoded($order->id)) }}">View</a></td>
                </tr>
            @empty
                <tr><td colspan="6">No orders in this section.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
