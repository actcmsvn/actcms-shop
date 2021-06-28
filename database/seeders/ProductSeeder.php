<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new Product();
        $product->name = 'Caprese';
        $product->description = 'Simple and easy pizza with mozzarella, tomatoes and gourmet pesto with balsamic caramel.';
        $product->price = 10;
        $product->image_url = '/images/products/1.jpeg';
        $product->save();
        $product = new Product();
        $product->name = 'El Paso';
        $product->description = 'Hot Mexican pizza with spicy beef, corn, bell peppers and jalapenos.';
        $product->price = 10;
        $product->image_url = '/images/products/2.jpeg';
        $product->save();
        $product = new Product();
        $product->name = 'Farmer\'s';
        $product->description = 'Original pizza with smoked potatoes, tender bacon, pickled cucumbers, crispy onions and tartar sauce.';
        $product->price = 10;
        $product->image_url = '/images/products/3.jpeg';
        $product->save();
        $product = new Product();
        $product->name = 'Four seasons';
        $product->description = 'Two hearty meat pizzas and two vegetarian pizzas in one - pepperoni, ham, mushrooms and a bright vegetable mix.';
        $product->price = 10;
        $product->image_url = '/images/products/4.jpeg';
        $product->save();


        $product = new Product();
        $product->name = 'Cheese';
        $product->description = 'Double mozzarella and tomato sauce is a minimalistic dish for the most selective in food.';
        $product->price = 10;
        $product->image_url = '/images/products/5.jpeg';
        $product->save();
        $product = new Product();
        $product->name = 'Amsterdam';
        $product->description = 'Delicate ham, champignons, soft mozzarella - a well-known delicious combination, and nothing more.';
        $product->price = 10;
        $product->image_url = '/images/products/6.jpeg';
        $product->save();
        $product = new Product();
        $product->name = 'BBQ';
        $product->description = 'Aromatic bacon, chicken, ham and bell peppers. Traditional American barbecue sauce gives the pizza a unique taste.';
        $product->price = 10;
        $product->image_url = '/images/products/7.jpeg';
        $product->save();
        $product = new Product();
        $product->name = 'Vegetarian';
        $product->description = 'Zucchini, cubes of refreshing cheese, bell peppers, olives, red onion and oregano.';
        $product->price = 10;
        $product->image_url = '/images/products/8.jpeg';
        $product->save();

        $product = new Product();
        $product->name = 'Hawaiian';
        $product->description = 'Pizza for connoisseurs of non-standard flavor combinations: tender ham, chicken and juicy pineapple.';
        $product->price = 10;
        $product->image_url = '/images/products/9.jpeg';
        $product->save();
        $product = new Product();
        $product->name = 'Margarita';
        $product->description = 'Lightly baked tomato cubes, soft, viscous mozzarella and a little oregano for flavor - the classic Margarita.';
        $product->price = 10;
        $product->image_url = '/images/products/10.jpeg';
        $product->save();
        $product = new Product();
        $product->name = 'Pepperoni';
        $product->description = 'Simple as all ingenious, spicy pizza with spicy Italian sausage pepperoni and jalapeno pepper.';
        $product->price = 10;
        $product->image_url = '/images/products/11.jpeg';
        $product->save();
        $product = new Product();
        $product->name = 'Mexico';
        $product->description = 'Spicy pizza with pepperoni, beef, bell pepper and hot jalapenos.';
        $product->price = 10;
        $product->image_url = '/images/products/12.jpeg';
        $product->save();
    }
}
