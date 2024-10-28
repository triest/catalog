<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexCatalogRequest;
use App\Services\Catalog\CatalogService;

class CatalogController extends Controller
{
    public CatalogService $catalogService;

    /**
     * @param null $catalogSerivce
     */
    public function __construct(CatalogService $catalogSerivce)
    {
        $this->catalogService = $catalogSerivce;
    }


    public function index(IndexCatalogRequest $request)
    {
        $goods = $this->catalogService->index($request->validated());

        return view('catalog.index')->with(compact('goods'));
    }
}
