<?php

namespace App\Http\Controllers;

use App\Http\Requests\Orders\GetOrdersRequest;
use App\Http\Requests\Orders\UpdateOrderRequest;
use App\Models\Order;
use App\Models\OrderStatus;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    private const PER_PAGE = 10;

    /**
     * List all orders.
     */
    public function index(GetOrdersRequest $request)
    {
        if ($request->has('sort')) {
            $sort = $request->get('sort');
            $direction = $request->get('order', 'asc');

            // Sort by query parameters
            $orders = Order::orderBy($sort, $direction)
                ->paginate(self::PER_PAGE)
                ->withQueryString();
        } else {
            $defaultSort = 'order_date';
            $defaultOrder = 'desc';

            // Apply default sorting
            $orders = Order::orderBy($defaultSort, $defaultOrder)->paginate(self::PER_PAGE);
        }

        return view('orders.index', compact('orders'));
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        $order->loadMissing('orderPictures');
        $orderTotal = $order->orderPictures()
            ->join('picture_sizes', 'order_pictures.pic_size_id', '=', 'picture_sizes.pic_size_id')
            ->selectRaw('ROUND(SUM(picture_sizes.pic_size_price * order_pictures.pic_qty), 2) AS total')
            ->value('total');
        return view('orders.show', compact('order', 'orderTotal'));
    }

    /**
     * Update the specified order.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        $status = $request->enum('order_status', OrderStatus::class);

        $data = match ($status) {
            OrderStatus::PENDING => [
                'order_completed_at' => null,
                'order_cancelled_at' => null,
            ],
            OrderStatus::COMPLETE => [
                'order_completed_at' => Carbon::now(),
                'order_cancelled_at' => null,
            ],
            OrderStatus::CANCELLED => [
                'order_completed_at' => null,
                'order_cancelled_at' => Carbon::now(),
            ],
        };

        $order->update($data);

        return redirect()->route('orders.show', compact('order'))->with('success', 'Order updated successfully');
    }

    /**
     * Remove the specified order.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully');
    }
}
