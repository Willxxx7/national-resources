<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\OrderDTO;
use App\DataTransferObjects\OrderPictureDTO;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    public function __construct(public OrderService $orderService)
    {

    }

    /**
     * Create a new order
     * @param StoreOrderRequest $request
     * @return JsonResponse
     * @throws \Throwable
     */
    public function store(StoreOrderRequest $request): JsonResponse
    {
        Gate::authorize('create', Order::class);
        $orderDto = OrderDTO::from(customerId: $request->user()->cust_id, orderNote: $request->input('orderNote'));
        DB::beginTransaction();
        try {
            // create order record
            $order = $this->orderService->createOrder($orderDto);
            $orderPictureDTOs = collect();

            // extract order picture data into a collection of DTOs
            foreach ($request->array('orderPictures') as $orderPictureRaw) {
                $orderPictureDTOs->add(
                    OrderPictureDTO::from(order: $order, picId: $orderPictureRaw['picId'], picSizeId: $orderPictureRaw['picSizeId'], picQty: $orderPictureRaw['picQty'])
                );
            }

            $this->orderService->createOrderPictures($orderPictureDTOs);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Order successfully placed',
                'order' => OrderResource::make($order->refresh()->loadMissing('orderPictures'))
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function cancelOrder(Order $order)
    {
        Gate::authorize('update', $order);

        if ($order->order_status === "cancelled") {
            return response(status: 204);
        }

        try {
            $order->update([
                'order_status' => 'cancelled'
            ]);
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Order successfully cancelled'
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function showOrder(Order $order)
    {
        Gate::authorize('view', $order);

        return response()->json([
            'success' => true,
            'order' => OrderResource::make($order->loadMissing('orderPictures'))
        ], 200);
    }
}
