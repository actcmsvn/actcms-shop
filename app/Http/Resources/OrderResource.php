<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ( isset($request->currency) && $request->currency == Product::CURRENCY_VND ) {
            $subtotal = number_format((float) $this->subtotal * Product::CURRENCY_VNDR_RATE, 0, ',', '.');
            $delivery = number_format((float) $this->delivery * Product::CURRENCY_VND_RATE, 0, ',', '.');
            $discount = number_format((float) $this->discount * Product::CURRENCY_VND_RATE, 0, ',', '.');
            $total = number_format((float) $this->total * Product::CURRENCY_VND_RATE, 0, ',', '.');
            $sign = Product::CURRENCY_EUR_SIGN;
        } else {
            $subtotal = $this->subtotal;
            $delivery = $this->delivery;
            $discount = $this->discount;
            $total = $this->total;
            $sign = Product::CURRENCY_USD_SIGN;
        }

        return [
            'id' => $this->id,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email,
            'subtotal' => $subtotal,
            'delivery' => $delivery,
            'discount' => $discount,
            'total' => $total,
            'sign' => $sign,
            'products' => OrderProductResource::collection($this->products),
        ];
    }
}
