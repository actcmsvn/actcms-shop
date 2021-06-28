<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property string $description
 * @property float $price
 * @property string $image_url
 */
class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'firstname',
        'lastname',
        'address',
        'phone',
        'email',
        'subtotal',
        'delivery',
        'discount',
        'total',
    ];

    protected $visible = [
        'id',
        'user_id',
        'firstname',
        'lastname',
        'address',
        'phone',
        'email',
        'subtotal',
        'delivery',
        'discount',
        'total',
    ];

    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'order_product',
            'order_id', 'product_id',
            'id', 'id')->using('App\Models\OrderProduct')->withPivot('price','count');
    }

}
