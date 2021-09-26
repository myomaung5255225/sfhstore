<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Support\Facades\Validator;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class OrderRepo.
 */
class OrderRepo extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Order::class;
    }

    public function orders($request)
    {
        $returnObj = array();
        $returnObj['statusCode'] = 500;
        try {
            $orders = Order::orderBy('updated_at')->with('user')->paginate($request->limit ?? 10);
            $returnObj['statusCode'] = 200;
            $returnObj['orders'] = $orders;
        } catch (\Throwable $th) {
            $returnObj['statusCode'] = 500;
            $returnObj['systemError'] = $th->getMessage();
        }
        return $returnObj;
    }

    public function ordersByUser($request)
    {
        $returnObj = array();
        $returnObj['statusCode'] = 500;
        try {
            $orders = $request->user()->orders;
            $returnObj['statusCode'] = 200;
            $returnObj['orders'] = $orders;
        } catch (\Throwable $th) {
            $returnObj['statusCode'] = 500;
            $returnObj['systemError'] = $th->getMessage();
        }
        return $returnObj;
    }

    public function addOrder($request)
    {
        $returnObj = array();
        $returnObj['statusCode'] = 500;
        try {
            $validator = Validator::make($request->all(), [
                'items' => 'required|array',
                'order_status' => 'required'
            ]);
            if ($validator->fails()) {
                $returnObj['statusCode'] = 422;
                $returnObj['errors'] = $validator->errors();
            } else {

                $request['user_id'] = $request->user()->id;
                $request['order_status'] = $request->order_status;
                $request['items'] = ($request->items);
                $order = Order::create($request->toArray());
                $returnObj['order'] = $order;
                $returnObj['statusCode'] = 201;
            }
        } catch (\Throwable $th) {
            $returnObj['statusCode'] = 500;
            $returnObj['systemError'] = $th->getMessage();
        }
        return $returnObj;
    }

    public function updateOrder($request, $id)
    {
        $returnObj = array();
        $returnObj['statusCode'] = 500;
        try {
            $validator = Validator::make($request->all(), [
                'items' => 'required|array',
                'order_status' => 'required'
            ]);
            if ($validator->fails()) {
                $returnObj['statusCode'] = 422;
                $returnObj['errors'] = $validator->errors();
            } else {
                $order = Order::findOrFail($id);
                if ($order) {
                    $order->user_id = $request->user()->id;
                    $order->items = $request->items;
                    $order->order_status = $request->order_status;
                    $order->save();
                    $returnObj['order'] = $order;
                    $returnObj['statusCode'] = 200;
                    $returnObj['message'] = 'Order  updated successfully';
                } else {
                    $returnObj['message'] = 'Order does not exist';
                    $returnObj['statusCode'] = 404;
                }
            }
        } catch (\Throwable $th) {
            $returnObj['statusCode'] = 500;
            $returnObj['systemError'] = $th->getMessage();
        }
        return $returnObj;
    }

    public function deleteOrder($id)
    {
        $returnObj = array();
        $returnObj['statusCode'] = 500;
        try {
            $order = Order::findOrFail($id);
            if ($order) {
                $order->delete();
                $returnObj['order'] = $order;
                $returnObj['statusCode'] = 200;
                $returnObj['message'] = 'Order  deleted successfully';
            } else {
                $returnObj['message'] = 'Order does not exist';
                $returnObj['statusCode'] = 404;
            }
        } catch (\Throwable $th) {
            $returnObj['statusCode'] = 500;
            $returnObj['systemError'] = $th->getMessage();
        }
        return $returnObj;
    }
}
