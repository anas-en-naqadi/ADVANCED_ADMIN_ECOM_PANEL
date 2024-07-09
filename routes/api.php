<?php

use App\Http\Controllers\Admin\BlacklistController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\SellController;

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductImagesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\ShippingController;
use App\Http\Controllers\User\WishListController;
use App\Models\ProductImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::get('/users', [UserController::class, 'users']);
    Route::get('/weeklySales', [DashboardController::class, 'weeklySalesChart']);
    Route::get('/monthlySales', [DashboardController::class, 'monthlySalesChart']);
    Route::get('/this-month', [DashboardController::class, 'getMonthlySales']);
    Route::get('/user-registrations', [DashboardController::class, 'monthlyUserRegistrations']);
    Route::get('/stock-by-category', [DashboardController::class, 'getStockByCategory']);
    Route::get('/customers', [InvoiceController::class, 'customers']);
    Route::get('/sells', [SellController::class, 'sells']);
    Route::get('/last-users', [UserController::class, 'getLastCustomers']);
    Route::get('/last-orders', [OrderController::class, 'getLastOrders']);
    Route::get('/dashboard-data', [DashboardController::class, 'dashboardData']);
    Route::get('/user', [UserController::class, 'getLoggedUser']);
    Route::get('/status-orders', [DashboardController::class, 'orderStatusPieChart']);
    Route::get('/notifications', [NotificationController::class, 'adminNotifications']);
    Route::post('/setReadAt', [NotificationController::class, 'setRead_at']);
    Route::post('/toAdmin', [UserController::class, 'setAsAdmin']);
    Route::post('/order-status', [OrderController::class, 'changeOrderStatus']);
    Route::resource('product', ProductController::class);
    Route::resource('order', OrderController::class);
    Route::resource('more-images', ProductImagesController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('invoice', InvoiceController::class);
    Route::resource('shipping', ShippingController::class);
    Route::resource('blacklist', BlacklistController::class);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/update-admin-profile',[UserController::class, 'updateAdminProfile']);
    Route::post('/update-pass', [UserController::class, 'updatePass']);
    Route::post('/changeStatus-user', [UserController::class, 'changeUserStatus']);
    Route::post('/store-user', [UserController::class, 'storeUser']);
    Route::post('/filterSellsByDates', [SellController::class, 'filterSellsByDates']);
    Route::post('/filterOrdersByDates', [OrderController::class, 'filterOrdersByDates']);
    Route::post('/filterInvoicesByDates', [InvoiceController::class, 'filterInvoicesByDates']);
});



Route::controller(CartController::class)->group(function () {
    //  Route::resource('cart');
    Route::post('/incrementCart', 'incrementQuantity');
    Route::post('/decrementCart', 'decrementQuantity');
});
Route::resource('wish-list', WishListController::class);

// Route::resource('review', ReviewController::class);


Route::middleware('guest')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});
Route::get('/test-redis', function () {
  

    // Retrieve a value from Redis
    $cachedData = Redis::get('monthly_sales');

    return response()->json(['cached_data' => $cachedData]);
});
