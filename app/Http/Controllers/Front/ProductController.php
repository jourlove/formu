<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;

class ProductController extends Controller
{
    //
    public function index() 
    {
        $products = Product::all();
        return view('front.product.index',compact('products'));
    }    
}
