<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\ProductRepo;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(ProductRepo $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function products(Request $request)
    {
        $returnObj = $this->productRepo->products($request);
        return response()->json($returnObj);
    }
    public function product($id)
    {
        $returnObj = $this->productRepo->product($id);
        return response()->json($returnObj);
    }

    public function addProduct(Request $request)
    {
        $returnObj = $this->productRepo->addProduct($request);
        return response()->json($returnObj);
    }

    public function updateProduct(Request $request, $id)
    {
        $returnObj = $this->productRepo->updateProduct($request, $id);
        return response()->json($returnObj);
    }
    public function deleteProduct($id)
    {

        $returnObj = $this->productRepo->deleteProduct($id);
        return response()->json($returnObj);
    }
}
