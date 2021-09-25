<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class CategoryRepo.
 */
class CategoryRepo extends BaseRepository
{

    public function model()
    {

        return Category::class;
    }


    public function categories($request)
    {
        $returnObj = array();
        $returnObj['statusCode'] = 500;
        try {
            $categories = Category::orderBy('updated_at', 'desc')->with('user')->paginate($request->limit ?? 10);
            $returnObj['categories'] = $categories;
            $returnObj['statusCode'] = 200;
        } catch (\Throwable $th) {
            $returnObj['systemError'] = $th->getMessage();
            $returnObj['statusCode'] = 500;
        }
        return $returnObj;
    }

    public function category($id)
    {
        $returnObj = array();
        $returnObj['statusCode'] = 500;
        try {
            $category = Category::where('id', $id)->with('user')->first();
            if ($category) {
                $returnObj['category'] = $category;
                $returnObj['statusCode'] = 200;
            } else {
                $returnObj['message'] = "Category doesn't exist!";
                $returnObj['statusCode'] = 404;
            }
        } catch (\Throwable $th) {
            $returnObj['systemError'] = $th->getMessage();
            $returnObj['statusCode'] = 500;
        }
        return $returnObj;
    }

    public function addCategory($request)
    {
        $returnObj = array();
        $returnObj['statusCode'] = 500;
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required'
            ]);
            if ($validator->fails()) {
                $returnObj['errors'] = $validator->errors();
                $returnObj['statusCode'] = 422;
            } else {
                if ($request->img) {
                    $request['img'] = ImageRepo::uploadImage($request->img);
                }
                $request['user_id'] = $request->user()->id;
                $request['description'] = $request->description;
                $category = Category::create($request->toArray());
                $returnObj['category'] = $category;
                $returnObj['message'] = 'Category created successfully!';
                $returnObj['statusCode'] = 201;
            }
        } catch (\Throwable $th) {
            $returnObj['systemError'] = $th->getMessage();
            $returnObj['statusCode'] = 500;
        }
        return $returnObj;
    }

    public function updateCategory($request, $id)
    {
        $returnObj = array();
        $returnObj['statusCode'] = 500;
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required'
            ]);
            if ($validator->fails()) {
                $returnObj['errors'] = $validator->errors();
                $returnObj['statusCode'] = 422;
            } else {
                $category = Category::findOrFail($id);
                if ($category) {
                    if ($request->img) {
                        $category->img = ImageRepo::updateImage($request->img, $category->img);
                    }
                    $category->name = $request->name;
                    $category->description = $request->description;
                    $category->user_id = $request->user()->id;
                    $category->save();
                    $returnObj['category'] = $category;
                    $returnObj['message'] = 'Category updated successfully!';
                    $returnObj['statusCode'] = 200;
                } else {
                    $returnObj['message'] = 'Category does not exist!';
                    $returnObj['statusCode'] = 404;
                }
            }
        } catch (\Throwable $th) {
            $returnObj['systemError'] = $th->getMessage();
            $returnObj['statusCode'] = 500;
        }
        return $returnObj;
    }

    public function deleteCategory($id)
    {
        $returnObj = array();
        $returnObj['statusCode'] = 500;
        try {
            $category = Category::findOrFail($id);
            if ($category) {
                $category->delete();
                $returnObj['category'] = $category;
                $returnObj['message'] = 'Category deleted successfully';
                $returnObj['statusCode'] = 200;
            } else {
                $returnObj['message'] = 'Category does not exist!';
                $returnObj['statusCode'] = 404;
            }
        } catch (\Throwable $th) {
            $returnObj['systemError'] = $th->getMessage();
            $returnObj['statusCode'] = 500;
        }
        return $returnObj;
    }
}
