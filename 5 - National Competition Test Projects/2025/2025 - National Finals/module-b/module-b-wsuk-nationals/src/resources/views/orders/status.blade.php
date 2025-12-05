@use('App\Models\OrderStatus')
@use('Carbon\Carbon')

@switch ($order->order_status)
    @case (OrderStatus::PENDING)
        <span class="status-badge status-pending">Pending</span>
    @break

    @case (OrderStatus::COMPLETE)
        <span class="status-badge status-complete">Complete</span>
        <span class="status-date">{{ Carbon::parse($order->order_completed_at)->format('Y-m-d H:i') }}</span>
    @break

    @case (OrderStatus::CANCELLED)
        <span class="status-badge status-cancelled">Cancelled</span>
        <span class="status-date">{{ Carbon::parse($order->order_cancelled_at)->format('Y-m-d H:i') }}</span>
    @break
@endswitch
