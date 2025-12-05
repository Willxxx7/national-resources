<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PictureSizeController;
use App\Http\Controllers\OrderController;

// all API routes are prefixed with v1
// {url}/api/v1/<route>
Route::prefix('v1')->group(function () {

    // -----
    // Test route to check if API is running and reachable
    // -----
    Route::get('/status', function () {
        return response()->json([
            'status' => 'success',
            'message' => 'API is running :)',
        ], 200);
    });

    // -----
    // Authentication related routes
    // -----
    Route::controller(AuthController::class)->group(function () {

        // login
        Route::post('/login', 'login');

        // register
        Route::post('/register', 'register');

        // logout -- requires a logged-in user
        Route::middleware('auth:sanctum')
            ->post('/logout', 'logout');
    });

    // -----
    // Routes requiring an authenticated user
    // Valid auth token required
    // -----
    Route::middleware('auth:sanctum')->group(function () {

        // -----
        // Customer profile related routes
        // -----
        Route::group(['prefix' => 'my', 'controller' => CustomerController::class], function () {

            // show profile information
            Route::get('profile', 'profileIndex');

            // update profile
            Route::put('profile', 'profileUpdate');

            // show events to which customer has access to
            Route::get('events', 'eventsIndex');

            // show orders made by current customer
            Route::get('orders', 'ordersIndex');


        });

        // -----
        // Order management routes - placing, viewing, cancelling, etc
        // -----
        Route::group(['prefix' => 'orders', 'controller' => OrderController::class], function () {

            // create new order
            Route::post('/', 'store');

            // cancel an order
            Route::patch('/{order}/cancel', 'cancelOrder');

            // show a single order
            Route::get('/{order}', 'showOrder');
        });
    });

    // -----
    // Public event routes
    // -----
    Route::group(['prefix' => 'events', 'controller' => EventController::class], function () {

        // get all public events -- paginated
        Route::get('/', 'index');

        // show a public event by id
        Route::get('/{event}', 'show');
    });

    // -----
    // Public category routes
    Route::group(['prefix' => 'categories', 'controller' => CategoryController::class], function () {

        // get all categories
        Route::get('/', 'index');
        Route::get('/{category}', 'show');
    });
    // -----

    // -----
    // Public picture size routes
    // -----
    Route::group(['prefix' => 'picture-sizes', 'controller' => PictureSizeController::class], function () {

        // get all picture sizes
        Route::get('/', 'index');
        Route::get('/{pictureSize}', 'show');
    });


    // ⚠️ reset database to default state
    Route::post('/db/reset', function () {
        try {
            Artisan::call('migrate:fresh --seed');
            return response()->json([
                'success' => true,
                'message' => 'Database has been reset successfully!',
                'timeOfReset' => now()->toDateTimeString()
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Database reset failed'
            ], 500);
        }
    });

});
