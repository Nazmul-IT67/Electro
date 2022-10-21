<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    function AddProduct()
    {
        $last_value=collect(request()->segments())->last();
        $last=Str::of($last_value)->replace('-','');
        return view('Backend.Products.product-add',[
            'last'=>$last,
            'category'=>Category::orderBy('category_name','asc')->get(),
        ]);
    }
}
