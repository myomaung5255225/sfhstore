<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\OrderRepo;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(OrderRepo $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }

    public function orders(Request $request)
    {
        $returnObj = $this->orderRepo->orders($request);
        return response()->json($returnObj);
    }
    public function ordersByUser(Request $request)
    {
        $returnObj = $this->orderRepo->ordersByUser($request);
        return response()->json($returnObj);
    }

    public function addOrder(Request $request)
    {
        $returnObj = $this->orderRepo->addOrder($request);
        return response()->json($returnObj);
    }

    public function updateOrder(Request $request, $id)
    {
        $returnObj = $this->orderRepo->updateOrder($request, $id);
        return response()->json($returnObj);
    }

    public function deleteOrder($id)
    {
        $returnObj = $this->orderRepo->deleteOrder($id);
        return response()->json($returnObj);
    }


}
