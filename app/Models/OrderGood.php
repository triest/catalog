<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderGood extends Model
{
    use HasFactory;

    protected $with = ['good'];

    public function good(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Good::class);
    }

    public function order(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
