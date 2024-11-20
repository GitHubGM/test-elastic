<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\ProductsSearchRequest;
use App\Services\Actions\Products\ProductsSearchAction;
use App\Services\Actions\Products\ProductsSearchEsAction;
use App\Services\Dto\Products\ProductsSearchDtoAction;
use Illuminate\Http\JsonResponse as HttpJsonResponse;

class ProductsController extends Controller
{
    public function index(ProductsSearchRequest $request, ProductsSearchAction $action):HttpJsonResponse
    {
        $data = $action->run(ProductsSearchDtoAction::fromRequest($request->validated()));
        return response()->json([
            'data' => $data['data'],
        ]);
    }
    public function es(ProductsSearchRequest $request, ProductsSearchEsAction $action):HttpJsonResponse
    {
        $data = $action->run(ProductsSearchDtoAction::fromRequest($request->validated()));
        return response()->json([
            'data' => $data['data'],
        ]);
    }
}
