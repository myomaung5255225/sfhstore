<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepo;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(CategoryRepo $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function categories(Request $request)
    {
        $returnObj = $this->categoryRepo->categories($request);
        return response()->json($returnObj);
    }

    public function category($id)
    {
        $returnObj = $this->categoryRepo->category($id);
        return response()->json($returnObj);
    }

    public function addCategory(Request $request)
    {
        $returnObj = $this->categoryRepo->addCategory($request);
        return response()->json($returnObj);
    }
    public function updateCategory(Request $request, $id)
    {
        $returnObj = $this->categoryRepo->updateCategory($request, $id);
        return response()->json($returnObj);
    }
    public function deleteCategory($id)
    {
        $returnObj = $this->categoryRepo->deleteCategory($id);
        return response()->json($returnObj);
    }
}
