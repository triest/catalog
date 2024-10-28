<?php

namespace App\Services\Order;

use App\DTO\OrderDTO;
use App\Models\Good;
use App\Models\Order;
use App\Models\OrderGood;
use App\Models\ShoppingCart;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderService
{

    public function index(User $user)
    {
        $orders = Order::query()->whereHas('user', function ($q) use ($user) {
            $q->where('id', $user->id);
        })->with('goods', 'goods.good')
            ->orderBy('created_at', 'desc');

        return $orders->paginate(10);
    }

    public function store(OrderDTO $orderDTO, User $user)
    {
        DB::beginTransaction();
        $order = new Order();
        $order->user()->associate($user);
        $order->save();
        try {
            foreach ($orderDTO->card['cards'] as $key => $card) {
                $cardId = $card;

                $quantity = $orderDTO->card['quantity'][$key];

                $card = Good::query()->where('id', $cardId)->firstOrFail();

                $orderGood = new OrderGood();

                $orderGood->order()->associate($order);

                $orderGood->good()->associate($card);

                $orderGood->quantity = $quantity;

                $orderGood->save();

                $this->deleteGoodFromCard($card, $quantity);
                //
            }
        } catch (\Exception $exception) {
            DB::rollBack();
        }

        DB::commit();
        return $order;
    }

    private function deleteGoodFromCard(Good $good, $quantity)
    {
        $user = Auth::user();

        $shoppingCard = ShoppingCart::query()
            ->whereHas('user', function ($q) use ($user) {
                $q->where('users.id', $user->id);
            })->whereHas('good', function ($q) use ($good) {
                $q->where('goods.id', $good->id);
            })->first();

        if (!$shoppingCard) {
            return null;
        }

        if ($shoppingCard->quantity == $quantity) {
            $shoppingCard->delete();
        } else {
            $shoppingCard->quantity = $shoppingCard->quantity - $quantity;
            $shoppingCard->save();
        }
    }


    public function priceAllOrders(User $user)
    {
        $orders = $user->orders;

        $price = 0;

        foreach ($orders as $order) {
            $price = +$order->calculatedPrice();
        }

        return $price;
    }


    public function desctoy(Order $order)
    {
        $order->goods()->delete();

        return $order->delete();
    }
}
