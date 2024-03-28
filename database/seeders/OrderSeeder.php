<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Purchase;
use App\Models\Rating;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $startDate = Carbon::now()->subMonths(2)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        $currentDate = $startDate->copy();

        $user = User::first();

        while ($currentDate <= $endDate) {
            // Create orders for each day
            $numberOfOrders = rand(1, 5); // Adjust the range as per your requirement

            for ($i = 0; $i < $numberOfOrders; $i++) {
                $customer = Customer::whereId(rand(1, 10))->first();

                //create order
                $order = Order::create([
                    "created_at" => $currentDate,
                    "updated_at" => $currentDate,
                    "user_id" => $user->id,
                    "customer_id" => $customer->id,
                ]);

                //create order items with raings
                for ($i = 0; $i < $numberOfOrders; $i++) {
                    $product_id = rand(1,30);
                    OrderItem::create([
                        "order_id" => $order->id,
                        "product_id" => $product_id,
                        "qty" => rand(1,10),
                        "amount" => 10,
                    ]);
                    Rating::create([
                        "customer_id" => $customer->id,
                        "order_id" => $order->id,
                        "product_id" => $product_id,
                        "rating" => rand(1, 5),
                        "created_at" => $currentDate,
                        "updated_at" => $currentDate,
                    ]);
                }

                //create purchace foreach order created
                Purchase::create([
                    "customer_id" => $customer->id,
                    "order_id" => $order->id,
                    "amount" => 100,
                    "created_at" => $currentDate,
                    "updated_at" => $currentDate,
                ]);


            }

            $currentDate->addDay();
        }
    }
}
