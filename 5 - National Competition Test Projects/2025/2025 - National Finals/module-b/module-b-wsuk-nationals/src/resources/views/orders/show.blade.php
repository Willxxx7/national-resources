@extends('layouts.app')

@use('Carbon\Carbon')
@use('App\Models\OrderStatus')

@section('content')

        <div>
            <a href="{{ route('orders.index') }}" class="back-link" style="margin-bottom: 1.5rem; display: inline-flex;">
                <i class="fa fa-arrow-left"></i>
                Back to Orders
            </a>
        </div>

        <div class="order-details-container">
            <h2>Order #{{ $order->order_id }}</h2>

            <table class="order-details-table">
                <tr>
                    <th>Order ID</th>
                    <td>{{ $order->order_id }}</td>
                </tr>
                <tr>
                    <th>Customer</th>
                    <td>{{ $order->customer->cust_name }}</td>
                </tr>
                <tr>
                    <th>Order Date</th>
                    <td>{{ Carbon::parse($order->order_date)->format('Y-m-d') }}</td>
                </tr>
                <tr>
                    <th>Note</th>
                    <td>{{ $order->order_note ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        @include('orders.status')
                    </td>
                </tr>
                <tr>
                    <th>Total:</th>
                    <td class="order-total">
                        £{{$orderTotal}}
                    </td>
                </tr>
            </table>
        </div>

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

                        <button type="submit" class="btn-icon btn-update" title="Mark as pending">
                            <i class="fa fa-undo"></i>
                        </button>
                    </form>
                    @break

                @case (OrderStatus::CANCELLED)
                    <form method="POST" action="{{ route('orders.update', $order) }}">
                        @csrf
                        @method('PATCH')

                        <input type="hidden" name="order_status" value="{{ OrderStatus::PENDING }}">

                        <button type="submit" class="btn-icon btn-update" title="Mark as pending">
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

        <div class="order-pictures-container">
            <h2>Order Pictures</h2>
            <div class="order-pictures">
                @foreach($order->orderPictures as $orderPicture)
                    <div class="order-picture-box">
                        <div class="order-picture-wrapper">
                            <img src="{{asset(sprintf('storage/%s', $orderPicture->picture->pic_path))}}"
                                 alt="{{$orderPicture->picture->pic_name}}">
                        </div>
                        <div class="order-picture-meta">
                            <h3>{{$orderPicture->picture->pic_locator}}</h3>
                            <div>
                                <strong>Event:</strong>
                                <span>{{$orderPicture->picture->event->event_name}}</span>
                            </div>
                            <div>
                                <strong>Size:</strong>
                                <span>{{$orderPicture->pictureSize->pic_size_label}}</span>
                            </div>
                            <div>
                                <strong>Unit Price:</strong>
                                <span>£{{number_format($orderPicture->pictureSize->pic_size_price, 2)}}</span>
                            </div>
                            <div>
                                <strong>Qty:</strong>
                                <span>{{$orderPicture->pic_qty}}</span>
                            </div>
                            <div>
                                <strong>Total:</strong>
                                <span>£{{number_format($orderPicture->pic_qty * $orderPicture->pictureSize->pic_size_price, 2)}}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


@endsection
