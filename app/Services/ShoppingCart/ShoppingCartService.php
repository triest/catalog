<?php

namespace App\Services\ShoppingCart;

use App\Http\Requests\StoreShoppingCardRequest;
use App\Models\Good;
use App\Models\ShoppingCart;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShoppingCartService
{

    public function index()
    {
        $user = Auth::user();

        $session_id = session()->getId();

        if ($user) {
            $shoppingCarts = $user->shoppingCarts;
        } else {
            $shoppingCarts = ShoppingCart::query()->where('session_id', $session_id)
                ->get();
        }

        return $shoppingCarts->load('good');
    }

    public function store(StoreShoppingCardRequest $request)
    {
        ;
        $data = $request->validated();

        $user = Auth::user();

        $session_id = session()->getId();


        DB::beginTransaction();

        $card = Good::where('id', $data['good_id'])->firstOrFail();

        $shoppingCard = ShoppingCart::query()->whereHas('good', function ($q) use ($card) {
            $q->where('id', $card->id);
        });

        if ($user) {
            $shoppingCard->whereHas('user', function ($q) use ($user) {
                $q->where('id', $user->id);
            });
        } else {
            $shoppingCard->where('session_id', $session_id);
        }

        $shoppingCard = $shoppingCard->first();

        if (!$shoppingCard) {
            $shoppingCard = new ShoppingCart();
            $shoppingCard->good()->associate($card);
            if ($user) {
                $shoppingCard->user()->associate($user);
            } else {
                $shoppingCard->session_id = $session_id;
            }
        }

        $shoppingCard->quantity = $shoppingCard->quantity + $data['quantity'];

        $shoppingCard->save();

        DB::commit();

        return $shoppingCard;
    }


    public function price(User $user){
         $price = 0;

         $shoppingCards = $user->shoppingCarts;

         foreach ($shoppingCards as $shoppingCard){
             $price = $price + $shoppingCard->calculatePrice();
         }

         return $price;
    }
}
