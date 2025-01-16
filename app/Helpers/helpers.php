<?php

use App\Models\Invoice;
use App\Models\Order;
use App\Models\Sell;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\URL;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

function getSimpleUser()
{
   return Auth::check() ? Auth::user() : null ;
}
 function getCachedData($cacheKey, $callback)
{
    if (Redis::exists($cacheKey)) {
        return json_decode(Redis::get($cacheKey));
    }

    $data = $callback();

    Redis::set($cacheKey, json_encode($data));
    Redis::expire($cacheKey, 60 * 60);
    return $data;
}
function clearDashboard(){
    Redis::del('monthly_user_registration');
    Redis::del('stock_by_category');
    Redis::del('monthly_sales');
    Redis::del('order_status');
    Redis::del('dashboard_data');
    Redis::del('weekly_sales');
    Redis::del('monthly_sales_Chart');
}
function storeImage($image)
{
    if (preg_match('/^data:image\/(\w+);base64,/', $image, $type)) {
        $image = substr($image, strpos($image, ','));
        $type = strtolower($type[1]);
        if (!in_array($type, ['jpg', 'jpeg', 'png', 'gif'])) {
            throw new Exception('invalid image type');
        }
        $image = str_replace('', '+', $image);
        $image = base64_decode($image);
    } else {
        throw new Exception('did not match data urL with image');
    }
    $dir = 'storage/images/products/';
    $file = Str::random() . '.' . $type;
    $absolutePath = public_path($dir);
    $relativePath = $dir . $file;
    if (!File::exists($absolutePath)) {
        File::makeDirectory($absolutePath, 0755, true);
    }

    file_put_contents($relativePath, $image);
    ImageOptimizer::optimize($absolutePath);
    return $relativePath;
}

function filterByDates(Request $request, string $type)
{
    $validatedData = $request->validate([
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
    ]);

    $startDate = Carbon::parse($validatedData['start_date'])->startOfDay();
    $endDate = Carbon::parse($validatedData['end_date'])->endOfDay();

    switch ($type) {
        case 'order':
            return Order::whereBetween('created_at', [$startDate, $endDate])
                ->with('customer') // Assuming 'customer' is the relationship method in your Order model
                ->get();
            break;
        case 'invoice':
            return Invoice::whereBetween('created_at', [$startDate, $endDate])
            ->with('customer','sells') // Assuming 'customer' is the relationship method in your Invoice model
            ->get()
        ->map(function ($invoice) {

            // Add additional attributes to the invoice object
            $invoice->sell_count = $invoice->sells->count();
            $invoice->customer_name = $invoice->customer->name;
            unset($invoice->sells);
            unset($invoice->customer);
            return $invoice;
        });

            break;
        case 'sell':

           return Sell::whereBetween('created_at', [$startDate, $endDate])->with('product')->get()->map(function ($sell){
            $sell->product->image = URL::to($sell->product->image);
            return $sell;
        });;
            break;
        default:
            // Handle unknown type gracefully
            return [];
            break;
    }
}

function cleanInputs(array &$array): void
{
    foreach ($array as $field => $value) {
        if (!is_array($value) && !is_uploaded_file($value)) {
            $array[$field] = Purify::clean($value);
        } else if (is_array($value)) {
            foreach ($value as $val) {
                $val = Purify::clean($val);
            }
        }
    }
}
