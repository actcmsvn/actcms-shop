<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use App\Services\ProductService;
use App\Services\UserService;
use Illuminate\Http\Request;
use \Exception;


class ProductController extends Controller
{

    /**
     * ProductController constructor.
     */
    public function __construct()
    {
    }



    public function getProducts(ProductService $productService, Request $request)
    {
        return $productService->getProducts($request);
    }

    public function getProduct(ProductService $productService, Request $request)
    {
        return $productService->getProduct($request);
    }

    public function getCart(ProductService $productService, Request $request)
    {
        return $productService->getCart($request);
    }

    public function postCheckout(ProductService $productService, UserService $userService, OrderService $orderService, Request $request)
    {
        $validator = $productService->validateCheckout($request->all());
        if ($validator->fails()) {
            return [
                'success' => false,
                'errors' => $validator->errors()
            ];
        }
        try {
            $user = $userService->getUserForCheckout($request);
            $products = $productService->getProductsForCheckout($request);
            if (!$products)
                return [ 'success' => false ];

            $orderService->newOrder()->calculateSubtotal($request, $products)->fillOrder($request, $user)->generateOrderItems($request, $products);
            return [ 'success' => true ];

        } catch (Exception $e) {
            return [ 'success' => false ];
        }
    }
}
