<?php

namespace App\Services\Catalog;

use App\Models\Good;

class CatalogService
{

    public const GoodsPerPage = 50;

    public function index()
    {
        $query = Good::query();

        return $query->paginate(self::GoodsPerPage);
    }
}
