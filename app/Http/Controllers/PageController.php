<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepo;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller

{
    public function __construct(ProductRepo $productRepo)
    {
        $this->productRepo = $productRepo;
    }
    public function home(Request $request)
    {
        $products = $this->productRepo->products($request);
        return Inertia::render('Home/Index',$products);
    }

    public function about()
    {
        return Inertia::render('About/Index');
    }
    public function contact()
    {
        return Inertia::render('Contact/Index');
    }
    public function privacy()
    {
        return Inertia::render('Privacy/Index');
    }
}
