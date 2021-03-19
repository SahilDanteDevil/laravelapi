<?php

namespace Database\Seeders;
use App\Models\OrderItem;
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
       \App\Models\Order::factory(30)->create()
       ->each(function(\App\Models\Order $order){
       	OrderItem::factory(random_int(1,5))->create([
       		'order_id' => $order->id,
       	]);
       });
    }
}
