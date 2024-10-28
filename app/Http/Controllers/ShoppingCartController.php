<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreShoppingCardRequest;
use App\Services\ShoppingCart\ShoppingCartService;
use Illuminate\Support\Facades\Auth;

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


        $price = $this->shoppingCardService2->price(Auth::user());

        return view('shopping-cart.index')->with(['carts' => $result,'price' =>$price]);
    }


    public function store(StoreShoppingCardRequest $request)
    {
        $result = $this->shoppingCardService2->store($request);


        return redirect()->back();
    }


}
