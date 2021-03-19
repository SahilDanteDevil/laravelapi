<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
/**
 * App\Models\OrderItem
 *
 * @method static \Database\Factories\OrderItemFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem query()
 * @mixin \Eloquent
 */
class OrderItem extends Model
{
    use HasFactory;

    protected $table = "orders_items";

    public function order()
    {
    	return $this->belongsTo(Order::class);
    }
}
