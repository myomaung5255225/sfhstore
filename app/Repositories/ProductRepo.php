<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class ProductRepo.
 */
class ProductRepo extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Product::class;
    }

    public function products($request)
    {
        $returnObj = array();
        $returnObj['statusCode'] = 500;
        try {

            $products =  Product::when(request()->has('category'), function ($q) {
                $q->where('category_id', request('category'));
            })->when(request()->has('name'), function ($q) {
                $q->where('name', 'like', '%' . request('name') . '%');
            })->orderBy('updated_at', 'desc')->with('user', 'category')->paginate($request->limit ?? 10);

            $returnObj['products'] = $products;
            $returnObj['statusCode'] = 200;
        } catch (\Throwable $th) {
            $returnObj['systemError'] = $th->getMessage();
            $returnObj['statusCode'] = 500;
        }
        return $returnObj;
    }

    public function product($id)
    {
        $returnObj = array();
        $returnObj['statusCode'] = 500;
        try {
            $product = Product::where('id', $id)->with('user', 'category')->first();
            if ($product) {
                $returnObj['product'] = $product;
                $returnObj['statusCode'] = 200;
            } else {
                $returnObj['message'] = 'Product does not exist';
                $returnObj['statusCode'] = 404;
            }
        } catch (\Throwable $th) {
            $returnObj['systemError'] = $th->getMessage();
            $returnObj['statusCode'] = 500;
        }
        return $returnObj;
    }
    public function addProduct($request)
    {
        $returnObj = array();
        $returnObj['statusCode'] = 500;
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:20',
                'category_id' => 'required',
                'short_description' => 'required|max:200',
                'description' => 'required',
                'stock' => 'required',
                'price' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                $returnObj['errors'] = $validator->errors();
                $returnObj['statusCode'] = 422;
            } else {
                if ($request->img) {
                    $request['img'] = $request->img;
                }
                $request['user_id'] = $request->user()->id;
                $product = Product::create($request->toArray());
                if ($product) {
                    $returnObj['product'] = $product;
                    $returnObj['message'] = 'Product created successfully!';
                    $returnObj['statusCode'] = 201;
                } else {
                    $returnObj['message'] = 'Product created fail';
                    $returnObj['statusCode'] = 400;
                }
            }
        } catch (\Throwable $th) {
            $returnObj['systemError'] = $th->getMessage();
            $returnObj['statusCode'] = 500;
        }
        return $returnObj;
    }

    public function updateProduct($request, $id)
    {
        $returnObj = array();
        $returnObj['statusCode'] = 500;
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:20',
                'category_id' => 'required',
                'short_description' => 'required|max:200',
                'description' => 'required',
                'stock' => 'required',
                'price' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                $returnObj['errors'] = $validator->errors();
                $returnObj['statusCode'] = 422;
            } else {
                $product = Product::findOrFail($id);
                if ($product) {
                    if ($request->img) {
                        $product->img = ImageRepo::updateImage($request->img, $product->img);
                    }
                    $product->name = $request['name'];
                    $product->description = $request['description'];
                    $product->short_description = $request['short_description'];
                    $product->category_id = $request['category_id'];
                    $product->stock = $request['stock'];
                    $product->user_id = $request->user()->id;

                    $product->save();
                    $returnObj['product'] = $product;
                    $returnObj['message'] = 'Product updated successfully';
                    $returnObj['statusCode'] = 200;
                } else {
                    $returnObj['message'] = 'Product does not exist';
                    $returnObj['statusCode'] = 404;
                }
            }
        } catch (\Throwable $th) {
            $returnObj['systemError'] = $th->getMessage();
            $returnObj['statusCode'] = 500;
        }
        return $returnObj;
    }

    public function deleteProduct($id)
    {
        $returnObj = array();
        $returnObj['statusCode'] = 500;
        try {
            $product = Product::findOrFail($id);
            if ($product) {
                $product->delete();
                ImageRepo::deleteImage($product->img);
                $returnObj['product'] = $product;
                $returnObj['message'] = 'Product deleted successfully';
                $returnObj['statusCode'] = 200;
            } else {
                $returnObj['message'] = 'Product does not exist';
                $returnObj['statusCode'] = 404;
            }
        } catch (\Throwable $th) {
            $returnObj['systemError'] = $th->getMessage();
            $returnObj['statusCode'] = 500;
        }
        return $returnObj;
    }
}
