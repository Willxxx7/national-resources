@extends('layouts.app')

@use('Carbon\Carbon')
@use('App\Models\OrderStatus')

@section('content')
    
        <h2>Orders</h2>

        @if (session('success'))
            <div class="status success">
                <p> {{ session('success') }}</p>
            </div>
        @endif

        <div class="table-responsive">
        <table>
            <thead>
            <tr>
                <th>
                    <a href="{{ route('orders.index', array_merge(request()->except('page'), ['sort' => 'order_id', 'order' => request('order') === 'asc' ? 'desc' : 'asc'])) }}"
                        @class(['sort-link', 'active' => request('sort') === 'order_id'])>
                        Order ID
                        @if (request('sort') === 'order_id')
                            @if (request('order') === 'asc')
                                <i class="fa fa-arrow-up"></i>
                            @elseif(request('order') === 'desc')
                                <i class="fa fa-arrow-down"></i>
                            @endif
                        @else
                            <i class="fa fa-arrow-right"></i>
                        @endif
                    </a>
                </th>
                <th>Customer</th>
                <th>
                    <a href="{{ route('orders.index', array_merge(request()->except('page'), ['sort' => 'order_date', 'order' => request('order') === 'asc' ? 'desc' : 'asc'])) }}"
                        @class([
                            'sort-link',
                            'active' => empty(request('sort')) || request('sort') === 'order_date',
                        ])>
                        Date

                        @if (request('sort') === 'order_date')
                            @if (request('order') === 'asc')
                                <i class="fa fa-arrow-up"></i>
                            @elseif(request('order') === 'desc')
                                <i class="fa fa-arrow-down"></i>
                            @endif
                        @elseif (empty(request('sort')))
                            <i class="fa fa-arrow-down"></i>
                        @else
                            <i class="fa fa-arrow-right"></i>
                        @endif
                    </a>
                </th>
                <th class="hide-mobile">Note</th>
                <th>
                    <a href="{{ route('orders.index', array_merge(request()->except('page'), ['sort' => 'order_completed_at', 'order' => request('order') === 'asc' ? 'desc' : 'asc'])) }}"
                        @class([
                            'sort-link',
                            'active' => request('sort') === 'order_completed_at',
                        ])>
                        Status

                        @if (request('sort') === 'order_completed_at')
                            @if (request('order') === 'asc')
                                <i class="fa fa-arrow-up"></i>
                            @elseif(request('order') === 'desc')
                                <i class="fa fa-arrow-down"></i>
                            @endif
                        @else
                            <i class="fa fa-arrow-right"></i>
                        @endif
                    </a>
                </th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($orders as $order)
                <tr>
                    <td>
                        <a href="{{route('orders.show', $order)}}">
                            Order #{{ $order->order_id }}
                        </a>
                    </td>
                    <td>{{ $order->customer->cust_name }}</td>
                    <td>{{ Carbon::parse($order->order_date)->format('Y-m-d') }}</td>
                    <td class="hide-mobile">{{ $order->order_note }}</td>
                    <td>
                        @include('orders.status')
                    </td>
                    <td>
                        <div class="actions">
                            @switch ($order->order_status)
                                @case (OrderStatus::PENDING)
                                    <form method="POST" action="{{ route('orders.update', $order) }}">
                                        @csrf
                                        @method('PATCH')

                                        <input type="hidden" name="order_status" value="{{ OrderStatus::COMPLETE }}">

                                        <button type="submit" class="btn-icon btn-complete" title="Complete order">
                                            <i class="fa fa-check"></i>
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('orders.update', $order) }}">
                                        @csrf
                                        @method('PATCH')

                                        <input type="hidden" name="order_status" value="{{ OrderStatus::CANCELLED }}">

                                        <button type="submit" class="btn-icon btn-cancel" title="Cancel order">
                                            <i class="fa fa-times-circle"></i>
                                        </button>
                                    </form>
                                    @break

                                @case (OrderStatus::COMPLETE)
                                    <form method="POST" action="{{ route('orders.update', $order) }}">
                                        @csrf
                                        @method('PATCH')

                                        <input type="hidden" name="order_status" value="{{ OrderStatus::PENDING }}">

                                        <button type="submit" class="btn-icon btn-reopen" title="Mark as pending">
                                            <i class="fa fa-undo"></i>
                                        </button>
                                    </form>
                                    @break

                                @case (OrderStatus::CANCELLED)
                                    <form method="POST" action="{{ route('orders.update', $order) }}">
                                        @csrf
                                        @method('PATCH')

                                        <input type="hidden" name="order_status" value="{{ OrderStatus::PENDING }}">

                                        <button type="submit" class="btn-icon btn-reopen" title="Mark as pending">
                                            <i class="fa fa-undo"></i>
                                        </button>
                                    </form>
                                    @break
                            @endswitch

                            <form method="POST" action="{{ route('orders.destroy', $order) }}">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn-icon btn-delete" title="Delete order">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No orders found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        </div>

        <div style="margin-top: 1.5rem;">
            {{ $orders->appends(request()->except('page'))->links() }}
        </div>
@endsection
