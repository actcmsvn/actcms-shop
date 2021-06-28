<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;


class ProductController extends Controller
{


    public function index()
    {
        return Inertia::render('Index');
    }

    public function productPage()
    {
        return Inertia::render('Product');
    }

    public function cart(Request $request)
    {
        return Inertia::render('Cart');
    }

    public function checkout(Request $request)
    {
        return Inertia::render('Checkout');
    }

    public function success(Request $request)
    {
        return Inertia::render('Success');
    }
}
