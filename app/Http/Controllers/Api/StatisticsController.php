<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\User\ProductResource;
use App\Http\Resources\Api\User\Task1Resource;
use App\Http\Resources\Api\User\Task2Resource;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\DB;


class StatisticsController extends Controller
{
    public function task1()
    {
        //Write a query that retrieves all users who have made a purchase in the last 30 days.
        //- Include their names, email addresses, and the total amount they have spent.

        $users = DB::table('customers')
            ->join('purchases', 'customers.id', '=', 'purchases.customer_id')
            ->select('customers.name', 'customers.email', DB::raw('SUM(purchases.amount) as total_amount'))
            ->where('purchases.created_at', '>=', now()->subDays(30))
            ->groupBy('customers.id', 'customers.name', 'customers.email')
            ->get();
        $result = (Task1Resource::collection($users));
        return msgdata(true, trans('lang.success'), $result, success());
    }

    public function task2()
    {
        //Write a query that retrieves the top 5 most purchased products.
        //- Include the product name, total quantity sold, and the average rating.

        $products = DB::table('purchases')
            ->join('order_items', 'purchases.order_id', '=', 'order_items.order_id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->leftJoin('ratings', 'products.id', '=', 'ratings.product_id')
            ->select('products.title', DB::raw('SUM(order_items.qty) as total_quantity_sold'), DB::raw('AVG(ratings.rating) as average_rating'))
            ->groupBy('products.id', 'products.title')
            ->orderByDesc('total_quantity_sold')
            ->limit(5)
            ->get();
        $result = (Task2Resource::collection($products));
        return msgdata(true, trans('lang.success'), $result, success());
    }

    public function part3(){
        $orders = Order::query()
            ->with('orderItems.product.category')
            ->whereHas('orderItems.product.category', function ($query) {
                $query->where('name', 'Electronics');
            })
            ->where('created_at', '>', now()->subDays(30))
            ->orderByDesc('created_at')
            ->limit(10)
            ->get(['orders.*']);

        // Retrieve the necessary data from the eager loaded relationships
        $products = $orders->pluck('orderItems')->flatten()->pluck('product')->unique();
        $categories = $products->pluck('category')->unique();

        // Access the required information
        $result = $products->map(function ($product) use ($categories) {
            $totalQuantitySold = $product->orderItems->sum('qty');
//            $totalQuantitySold = $product->orderItems ? $product->orderItems->sum('qty') : 0;

            $averageRating = $product->ratings()->avg('rating');

            return [
                'product_name' => $product->title,
                'total_quantity_sold' => $totalQuantitySold,
                'average_rating' => $averageRating,
            ];
        });

        // Sort the result based on total quantity sold in descending order
        $result = $result->sortByDesc('total_quantity_sold')->take(10)->values();

        return $result;
    }


}

