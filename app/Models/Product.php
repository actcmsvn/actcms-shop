<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property string $description
 * @property float $price
 * @property string $image_url
 */
class Product extends Model
{
    protected $table = 'products';

    const DELIVERY_PRICE = 1.00;
    const DISCOUNT_PRICE = 0.00;

    const CURRENCY_VND = 'VND';
    const CURRENCY_VND_RATE = 23020.00;
    const CURRENCY_USD_SIGN = '$';
    const CURRENCY_VND_SIGN = 'đ';


    protected $fillable = [
        'name',
        'description',
        'price',
        'image_url',
    ];

    protected $visible = [
        'id',
        'name',
        'description',
        'price',
        'image_url',
    ];


}
