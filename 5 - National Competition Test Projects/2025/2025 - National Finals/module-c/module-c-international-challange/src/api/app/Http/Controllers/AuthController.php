<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Register a new customer user
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        // create customer from validated data
        $data = [
            'cust_fname' => $request->validated('customerFirstname'),
            'cust_lname' => $request->validated('customerLastname'),
            'cust_email' => $request->validated('customerEmail'),
            'cust_phone' => $request->validated('customerPhone'),
            'cust_addr1' => $request->validated('customerAddressFirst'),
            'cust_addr2' => $request->validated('customerAddressSecond'),
            'cust_postcode' => $request->validated('customerPostcode'),
            'cust_password' => $request->validated('customerPassword'),
        ];
        $customer = Customer::create($data);
        if (!$customer) {
            return response()->json([
                'success' => false,
                'message' => 'Customer creation failed',
                'data' => []
            ], 400);
        }

        // create api access token
        $token = $customer->createToken('customer_token')->plainTextToken;
        return response()->json([
            'success' => true,
            'message' => 'Successful customer registration',
            'token' => $token,
            'customer' => CustomerResource::make($customer->refresh())
        ], 201);
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $customer = Customer::whereCustEmail($request->validated('email'))->first();

        // on invalid email and/or password
        if (!$customer || !Hash::check($request->validated('password'), $customer->cust_password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        // successful login, create token
        $token = $customer->createToken('customer_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'token' => $token,
            'customer' => CustomerResource::make($customer)
        ]);
    }

    /**
     * Logout a customer
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        if ($request->user()->tokens()->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Logout successful'
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Error at logging out'
        ], 400);
    }
}
