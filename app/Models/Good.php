<?php

namespace App\Models;

use Database\Factories\GoodFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return GoodFactory::new();
    }
}
