<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\Sell;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function orderStatusPieChart()
    {
        // Retrieve counts of orders with different statuses
        $returnedCount = Order::where('status', 'completed')->count();
        $confirmedCount = Order::where('status', 'processing')->count();
        $canceledCount = Order::where('status', 'in progress')->count();

        // Calculate total number of orders
        $totalCount = $returnedCount + $confirmedCount + $canceledCount;

        if ($totalCount > 0) {
            // Calculate percentage for each status
            $returnedPercentage = $returnedCount / $totalCount * 100;
            $confirmedPercentage = $confirmedCount / $totalCount * 100;
            $canceledPercentage = $canceledCount / $totalCount * 100;
        } else {
            // Set percentages to 0 if there are no orders
            $returnedPercentage = 0;
            $confirmedPercentage = 0;
            $canceledPercentage = 0;
        }

        // Prepare data for the pie chart
        $labels = ['Returned', 'Confirmed', 'Canceled'];
        $data = [$returnedPercentage, $confirmedPercentage, $canceledPercentage];

        $colors = ['#FF0000', '#00FF00', '#0000FF']; // Red, Green, Blue

        // Return the data
        return response()->json(['labels' => $labels, 'data' => $data, 'backgroundColor' => $colors]);
    }
    public function dashboardData()
    {
        $todayMoney = Order::whereDate('created_at', today())->sum('amount');
        $todaysUsers = User::whereDate('created_at', today())->count();
        $newClients = Order::whereDate('created_at', today())->distinct()->count('user_id');
        $todaysSalesAmount = Sell::whereDate('created_at', today())->sum('total_amount');
        $thisWeekSalesAmount = Sell::whereBetween('created_at', [today()->startOfWeek(), today()->endOfWeek()])->sum('total_amount');
        // Retrieve data from the previous period (e.g., yesterday)
        $yesterdayMoney = Order::whereDate('created_at', today()->subDay())->sum('amount');
        // Retrieve the number of users created on the same day of the previous month
        $previousMonthUsers = User::whereDate('created_at', today()->subMonth()->startOfMonth())->count();
        $previousWeekSalesAmount = Sell::whereBetween('created_at', [today()->startOfWeek()->subWeek(), today()->endOfWeek()->subWeek()])->sum('total_amount');

        $yesterdayNewClients = Order::whereDate('created_at', today()->subDay())->distinct()->count('user_id');
        $yesterdaySalesAmount = Sell::whereDate('created_at', today()->subDay())->sum('total_amount');

        // Calculate the changes
        $salesWeekChange = $thisWeekSalesAmount != 0 ? (($thisWeekSalesAmount - $previousWeekSalesAmount) / $thisWeekSalesAmount) * 100 : 0;


        $moneyChange = $todayMoney != 0 ? (($todayMoney - $yesterdayMoney) / $todayMoney) * 100 : 0;
        $usersChange = $todaysUsers != 0 ? (($todaysUsers - $previousMonthUsers) / $todaysUsers) * 100 : 0;
        $newClientsChange = $newClients != 0 ? (($newClients - $yesterdayNewClients) / $newClients) * 100 : 0;
        $salesAmountChange = $todaysSalesAmount != 0 ? (($todaysSalesAmount - $yesterdaySalesAmount) / $todaysSalesAmount) * 100 : 0;

        // Ensure the changes are within the range of -100 to 100
        $moneyChange = number_format(min(100, max(-100, $moneyChange)), 1);
        $usersChange = number_format(min(100, max(-100, $usersChange)), 1);
        $newClientsChange = number_format(min(100, max(-100, $newClientsChange)), 1);
        $salesAmountChange = number_format(min(100, max(-100, $salesAmountChange)), 1);
        $salesWeekChange = number_format(min(100, max(-100, $salesWeekChange)), 1);
        // Return the data with changes
        return [
            'todayMoney' => $todayMoney,
            'moneyChange' => $moneyChange,
            'todaysUsers' => $todaysUsers,
            'usersChange' => $usersChange,
            'newClients' => $newClients,
            'newClientsChange' => $newClientsChange,
            'todaysSalesAmount' => $todaysSalesAmount,
            'salesAmountChange' => $salesAmountChange,
            'thisWeekSalesAmount' => $thisWeekSalesAmount,
            'salesWeekChange' => $salesWeekChange,
        ];
    }
    public function weeklySalesChart()
    {
        // Get the current week's start and end dates
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        // Query the database to get weekly sales data
        $weeklySales = Sell::whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->selectRaw('DAYNAME(created_at) as day_name, SUM(total_amount) as total_sales')
            ->groupBy('day_name')
            ->orderByRaw('FIELD(day_name, "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday")')
            ->get();

        // Initialize sales data for all seven days to 0
        $salesData = [
            'Monday' => 0,
            'Tuesday' => 0,
            'Wednesday' => 0,
            'Thursday' => 0,
            'Friday' => 0,
            'Saturday' => 0,
            'Sunday' => 0,
        ];

        // Fill in the actual sales data for days where sales exist
        foreach ($weeklySales as $sale) {
            $salesData[$sale->day_name] = $sale->total_sales;
        }

        // Format the data for chart.js
        $labels = array_keys($salesData);
        $data = array_values($salesData);

        return response()->json(['labels' => $labels, 'data' => $data]);
    }




    public function monthlySalesChart()
    {
        // Get the current year
        $currentYear = Carbon::now()->year;

        // Query the database to get monthly sales data for the current year
        $monthlySales = Sell::whereYear('created_at', $currentYear)
            ->selectRaw('MONTHNAME(created_at) as month_name, SUM(total_amount) as total_sales')
            ->groupByRaw('MONTHNAME(created_at)')
            ->orderByRaw('MONTH(created_at)')
            ->get();

        // Initialize sales data for all twelve months to 0
        $salesData = [
            'January' => 0,
            'February' => 0,
            'March' => 0,
            'April' => 0,
            'May' => 0,
            'June' => 0,
            'July' => 0,
            'August' => 0,
            'September' => 0,
            'October' => 0,
            'November' => 0,
            'December' => 0,
        ];

        // Fill in the actual sales data for months where sales exist
        foreach ($monthlySales as $sale) {
            $salesData[$sale->month_name] = $sale->total_sales;
        }

        // Format the data for chart.js
        $labels = array_keys($salesData);
        $data = array_values($salesData);

        return response()->json(['labels' => $labels, 'data' => $data]);
    }
}
