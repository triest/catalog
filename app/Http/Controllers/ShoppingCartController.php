<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreShoppingCardRequest;
use App\Services\ShoppingCart\ShoppingCartService;

class ShoppingCartController extends Controller
{
    public ShoppingCartService $shoppingCardService2;


    public function __construct(ShoppingCartService $shoppingCardService)
    {
        $this->shoppingCardService2 = $shoppingCardService;
    }

    public function index()
    {
        $result = $this->shoppingCardService2->index();

        return view('shopping-cart.index')->with(['carts' => $result]);
    }


    public function store(StoreShoppingCardRequest $request)
    {
        $result = $this->shoppingCardService2->store($request);


        return redirect()->back();
    }


}
