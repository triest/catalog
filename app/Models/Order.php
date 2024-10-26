<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;


    public function goods()
    {
        return $this->hasMany(OrderGood::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getItemsString()
    {
        $string = '';
        $goods = $this->goods;
        $totalCount = $goods->count();
        $count = 0;
        foreach ($goods as $orderGood) {
            $string .= $orderGood?->good?->name;
            if($count<$totalCount-1){
                $string .=', ';
            }
            $count++;
        }
        return $string;
    }

    public function calculatedPrice()
    {
        $goods = $this->goods;
        $resultPrice = 0;
        foreach ($goods as $orderGood) {
            $price = $orderGood?->good?->price;
            if (is_null($price)) {
                continue;
            }

            $resultPrice = $resultPrice + $price * $orderGood->quantity;
        }

        return $resultPrice;
    }
}
