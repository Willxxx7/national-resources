<?php

namespace App\Http\Controllers;

use App\Filters\EventFilter;
use App\Filters\OrderFilter;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\EventResource;
use App\Http\Resources\OrderResource;
use App\Models\Customer;
use App\Models\Event;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CustomerController extends Controller
{
    /**
     * Show profile information about the customer
     * @param Request $request
     * @return JsonResponse
     */
    public function profileIndex(Request $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'customer' => CustomerResource::make($request->user())
        ]);
    }

    /**
     * Show events to which the logged-in customer has access to
     * @param Request $request
     * @param EventFilter $filters
     * @return JsonResponse
     */
    public function eventsIndex(Request $request, EventFilter $filters): JsonResponse
    {
        $user = $request->user();
        $events = Event::query()->whereHas('eventAccesses', function (Builder $builder) use ($user) {
            return $builder->where('cust_id', $user->cust_id);
        })
            ->filter($filters)
            ->get();

        return response()->json([
            'success' => true,
            'events' => EventResource::collection($events)
        ]);
    }

    /**
     * Show events belonging to customer
     * @param Request $request
     * @param OrderFilter $filters
     * @return JsonResponse
     */
    public function ordersIndex(Request $request, OrderFilter $filters): JsonResponse
    {
        $user = $request->user();
        $orders = Order::query()
            ->where('cust_id', $user->cust_id)
            ->filter($filters)
            ->orderBy('orders.order_date', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'orders' => OrderResource::collection($orders)
        ]);
    }

    public function profileUpdate(UpdateCustomerRequest $request)
    {
        $data = [
            'cust_fname' => $request->validated('customerFirstname'),
            'cust_lname' => $request->validated('customerLastname'),
            'cust_phone' => $request->validated('customerPhone'),
            'cust_addr1' => $request->validated('customerAddressFirst'),
            'cust_addr2' => $request->validated('customerAddressSecond'),
            'cust_postcode' => $request->validated('customerPostcode'),
        ];

        try {
            $customer = Customer::where('cust_id', auth()->user()->cust_id)->first();
            $customer->update($data);
            return response()->json([
                'success' => true,
                'message' => 'Customer successfully updated',
                'customer' => CustomerResource::make($customer->refresh())
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => "Customer update failed, {$e->getMessage()}"
            ], 500);
        }

    }

}
