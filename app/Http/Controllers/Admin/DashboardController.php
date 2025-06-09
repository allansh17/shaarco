<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Dealer;
use App\Models\Staff;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Order;
use App\Models\DealerOrderRequest;
use App\Models\ProductOrder;
use App\Models\ProjectCustomer;
use App\Models\Quotation;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;



use Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{public function index(Request $request)
{
    $orders = Order::select(
        DB::raw('DATE(orders.created_at) as Date'),
        DB::raw('SUM(orders.total_amount) as TotalSale'),
        DB::raw('COUNT(DISTINCT orders.id) as NumberOfOrders'),
        'order_status as orderstatus'
    )
    ->where('order_status', 4) // Ensure it's an integer
    ->get();

    $totalorders = Order::select(
        DB::raw('COUNT(DISTINCT orders.id) as NumberOfOrders') // Removed extra comma
    )->get();

    $customers = Customer::select(
        DB::raw('COUNT(id) as NumberOfCustomers')
    )->get();

    $customersdata = Customer::orderBy('id', 'desc') // Sort by the latest customers
        ->limit(5) // Limit the results to 5
        ->get();

    $totalproducts = Product::count();

    $topProducts = Product::select(
        'products.id',
        'products.name',
        'products.status',
        DB::raw('COUNT(product_orders.id) as order_count')
    )
    ->join('product_orders', 'products.id', '=', 'product_orders.product_id')
    ->groupBy('products.id', 'products.name', 'products.status') // Added 'status' to groupBy
    ->orderBy('order_count', 'desc')
    ->limit(5)
    ->get();

    $category = Category::count();

    $orders_products = Order::select(
        'category.name as category_name',
        DB::raw('COUNT(DISTINCT products.category_id) as NumberOfOrders')
    )
    ->leftJoin('product_orders', 'orders.id', '=', 'product_orders.checkout_id')
    ->leftJoin('products', 'product_orders.product_id', '=', 'products.id')
    ->leftJoin('category', 'products.category_id', '=', 'category.id')
    ->groupBy('category.id', 'category.name') // Fixed groupBy
    ->orderBy('orders.id', 'desc')
    ->limit(5)
    ->get();

    $sales = Order::select(
        DB::raw('DATE(orders.created_at) as Date'),
        DB::raw('COUNT(orders.id) as TotalSale'),
        DB::raw('DATE_FORMAT(created_at, "%Y") as create_year')
    )
    ->where('order_status', 4) // Ensure it's an integer
    ->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y")'))
    ->orderBy('created_at', 'asc')
    ->get();

    // Initialize salesData to prevent errors if $sales is empty
    $salesData = [];

    foreach ($sales as $data) {
        $salesData[$data->create_year] = $data->TotalSale;
    }

    $growthRates = [];
    $previousSales = null;

    foreach ($salesData as $year => $salesAmount) {
        if ($previousSales !== null) {
            $growthRates[$year] = $this->calculateGrowth($previousSales, $salesAmount);
        } else {
            $growthRates[$year] = 0;
        }
        $previousSales = $salesAmount;
    }

    $latestOrders = Order::select(
        'orders.*',
        DB::raw('CONCAT(customers.first_name, " ", customers.last_name) as customer_name')
    )
    ->leftJoin('customers', 'orders.customer_id', '=', 'customers.id')
    ->orderBy('orders.id', 'desc')
    ->limit(5)
    ->get();

    return view('pages.dashboard', compact(
        'category',
        'orders',
        'orders_products',
        'growthRates',
        'salesData',
        'customers',
        'totalorders',
        'customersdata',
        'topProducts',
        'latestOrders',
        'totalproducts'
    ));
}


    // for Order Statisticschart start

    public function orderstatisticschart(Request $request)
    {
        // $orders_products = ProductOrder::select(
        //     DB::raw('COUNT(DISTINCT product_orders.product_id) as NumberOfOrders'),
        //     'products.product_type'
        // )
        //     ->join('products', 'product_orders.product_id', '=', 'products.id')
        //     ->groupBy('products.product_type') // Group by product_type
        //     ->get();
        $orders_products = Order::select(
            'orders.*',
            'category.name as category_name',
            DB::raw('COUNT(DISTINCT products.category_id) as NumberOfOrders'),
        )
            ->leftJoin('product_orders', 'orders.id', '=', 'product_orders.checkout_id')
            ->leftjoin('products', 'product_orders.product_id', '=', 'products.id')
            ->leftJoin('category', 'products.category_id', '=', 'category.id')

            ->groupBy('products.category_id')
            ->orderBy('orders.id', 'desc')
            // ->limit(5)
            ->get();

        $series = [];
        $categories = [];
        $totalproducts = 0;
        foreach ($orders_products as $order) {
            $series[] = $order->NumberOfOrders;
            $categories[] = $order->category_name;
            $totalproducts += $order->NumberOfOrders;
        }
        $data = [
            'series' => $series,
            'categories' => $categories,
            'totalproducts' => $totalproducts
        ];
        return response()->json($data);
    }
    //end

    // for Revenuechart start

    public function fetchDatatotalrevenue(Request $request)
    {
        $orders_products = Order::select(
            DB::raw('DATE(orders.created_at) as Date'),
            DB::raw('count(DISTINCT orders.id) as TotalSale'),
            DB::raw('COUNT(DISTINCT orders.id) as NumberOfOrders'),
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as create_month'),
            'created_at as create_date' // Format as Year-Month
        )
            ->where('order_status', '4')
            ->groupBy('create_month')
            ->get();
        // dd($orders_products);
        $series = [];
        $categories = [];
        $created_month = [];
        $yearly_data = [];
        foreach ($orders_products as $order) {
            $year = Carbon::parse($order->create_date)->format('Y');
            $month = Carbon::parse($order->create_month)->format('M');
            // $productType = ($order->product_type == 1) ? 'products' : 'accessories';
            if (!isset($yearly_data[$year])) {
                $yearly_data[$year] = [
                    'name' => $year,
                    'data' => [],
                    'months' => [],
                ];
            }
            $yearly_data[$year]['data'][] = $order->TotalSale;
            $yearly_data[$year]['months'][] = $month;
            // $categories[] = $productType;
            $created_month[] = $month;
        }
        $series = array_values($yearly_data);
        $data = [
            'series' => $series,
            'categories' => $categories,
            'year' => array_keys($yearly_data),
            'month' => $created_month,
        ];
        return response()->json($data);
    }


    public function growthcharts(Request $request)
    {
        $salesQuery = Order::select(
            DB::raw('DATE(orders.created_at) as Date'),
            DB::raw('count(orders.id) as TotalSale'),
            DB::raw('COUNT(DISTINCT orders.id) as NumberOfOrders'),
            DB::raw('DATE_FORMAT(created_at, "%Y") as create_year')
        )
            ->where('order_status', '4');


        if ($request->year && !empty($request->year)) {
            $requestedYear = $request->year;
            $previousYear = $requestedYear - 1;
            $salesQuery->whereIn(DB::raw('DATE_FORMAT(created_at, "%Y")'), [$requestedYear, $previousYear]);
        }
        $salesQuery->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y")'));
        $sales = $salesQuery->get();
        $salesData = [];

        if ($request->year && !empty($request->year)) {
            $previous = [$sales->last()->create_year => $sales->last()->TotalSale];
            $current = [$sales->first()->create_year => $sales->first()->TotalSale];
            foreach ($sales as $data) {
                $salesData[$data->create_year] = $data->TotalSale;
            }
        } else {
            $previous = '';
            $current = '';
            foreach ($sales as $data) {
                $salesData[$data->create_year] = $data->TotalSale;
            }
        }

        $growthRates = [];
        $previousSales = null;
        foreach ($salesData as $year => $saless) {
            if ($previousSales !== null) {
                $growthRates[$year] = $this->calculateGrowth($previousSales, $saless);
            } else {
                $growthRates[$year] = 0;
            }
            $previousSales = $saless;
        }

        $data = [
            'series' => $growthRates,
            'previous' => $previous,
            'curent' => $current,
        ];

        return response()->json($data);
    }

    // Updated calculateGrowth function to cap growth at 100%
    function calculateGrowth($previousYearSales, $currentYearSales)
    {
        if ($previousYearSales == 0) {
            return 0;
        }

        $growth = (($currentYearSales - $previousYearSales) / $previousYearSales) * 100;
        $growth = round($growth, 2); // Round the result to 2 decimal places

        // Ensure the growth percentage doesn't exceed 100%
        if ($growth > 100) {
            return 100;
        }

        return $growth;
    }


    // end


    // for income Charts

    public function incomecharts(Request $request)
    {
        // dd($request->all());

        if ($request->type == 'expense') {
            $orders_products = ProductOrder::select(
                DB::raw('COUNT(product_orders.id) as NumberOfOrders'),
                'products.product_type',
                DB::raw('DATE_FORMAT(product_orders.created_at, "%Y-%m") as create_month'),
                'product_orders.created_at as create_date', // Format as Year-Month
                
            )
                ->join('products', 'product_orders.product_id', '=', 'products.id')
                ->groupBy(DB::raw('DATE_FORMAT(product_orders.created_at, "%Y-%m")')) // Group by Year-Month and product type
                ->get();
        } elseif ($request->type == 'profit') {
            $orders_products = DB::table('orders')
                ->select(
                    DB::raw('DATE_FORMAT(orders.created_at, "%Y-%m") as create_month'),
                    // DB::raw('(SUM(orders.total_amount) - IFNULL(SUM(product_orders.price * product_orders.qty), 0)) as TotalSale'),
                    DB::raw('COUNT(DISTINCT orders.id) as NumberOfOrders'),
                    DB::raw('COUNT(product_orders.id) as NumberOfProductOrders'),
                    'product_orders.created_at as create_date',
                )
                ->leftJoin('product_orders', 'orders.id', '=', 'product_orders.checkout_id')
                ->groupBy(DB::raw('DATE_FORMAT(orders.created_at, "%Y-%m")'))
                ->get();
        } else {
            $orders_products = Order::select(
                DB::raw('DATE(orders.created_at) as Date'),
                DB::raw('SUM(orders.total_amount) as TotalSale'),
                DB::raw('COUNT(DISTINCT orders.id) as NumberOfOrders'),
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as create_month'),
                'created_at as create_date'
            )
                ->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m")'))
                ->get();
        }
        // $orders_products = ProductOrder::select(
        //     DB::raw('COUNT(product_orders.id) as NumberOfOrders'),
        //     'products.product_type',
        //     DB::raw('DATE_FORMAT(product_orders.created_at, "%Y-%m") as create_month'),
        //     'product_orders.created_at as create_date' // Format as Year-Month
        // )
        //     ->join('products', 'product_orders.product_id', '=', 'products.id')
        //     ->groupBy(DB::raw('DATE_FORMAT(product_orders.created_at, "%Y-%m")')) // Group by Year-Month and product type
        //     ->get();

        $series = [];
        // $categories = [];
        $created_month = [];
        $yearly_data = [];
        $totalsales = 0;
        foreach ($orders_products as $order) {
            $year = Carbon::parse($order->create_date)->format('Y');
            $month = Carbon::parse($order->create_month)->format('M');
            $totalsales += $order->TotalSale;
            // $productType = ($order->product_type == 1) ? 'products' : 'accessories';
            if (!isset($yearly_data[$year])) {
                $yearly_data[$year] = [
                    'name' => $year,
                    'data' => []
                ];
            }
            $yearly_data[$year]['data'][] = $order->TotalSale;
            // $categories[] = $productType;
            $created_month[] = $month;
        }
        $series = array_values($yearly_data);
        $data = [
            'toatalsales' => $totalsales,
            'series' => $series,
            'year' => array_keys($yearly_data),
            'month' => $created_month,
        ];
        return response()->json($data);
    }
}
