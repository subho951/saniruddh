@php
    $orderGroups = [
        'Placed' => $getCustOrders1,
        'Confirmed' => $getCustOrders2,
        'Shipped' => $getCustOrders3,
        'Delivered' => $getCustOrders4,
        'Cancelled' => $getCustOrders5,
        'Completed' => $getCustOrders6,
        'Cancellation Requests' => $getCustOrders7,
    ];
    $statusLabels = [1 => 'Placed', 2 => 'Confirmed', 3 => 'Shipped', 4 => 'Delivered', 5 => 'Cancelled', 6 => 'Completed', 7 => 'Cancellation Requested'];
@endphp

@include('front.elements.user-page-title', ['userPageTitle' => 'Orders', 'userPageCopy' => 'Track the progress of your boutique orders.'])

<div class="accordion storefront-orders-accordion" id="orders-accordion">
    @foreach($orderGroups as $groupTitle => $orders)
        <div class="accordion-item">
            <h2 class="accordion-header"><button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#orders-{{ $loop->index }}">{{ $groupTitle }} ({{ $orders->count() }})</button></h2>
            <div id="orders-{{ $loop->index }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" data-bs-parent="#orders-accordion">
                <div class="accordion-body">@include('front.elements.user-order-table', ['orders' => $orders, 'orderStatusLabels' => $statusLabels])</div>
            </div>
        </div>
    @endforeach
</div>
