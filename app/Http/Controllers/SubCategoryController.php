<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    function SubCategory()
    {
        $last_value=collect(request()->segments())->last();
        $last=Str::of($last_value)->replace('-','-');
        return view('Backend.SubCategory.sbucategory-add',[
            'last'=>$last,
            'category'=>Category::orderBy('category_name', 'asc')->get(),
        ]);
    }

    function SubCategoryPost(Request $request)
    {
        $request->validate([
            'category_id'     =>['required'],
            'subcategory_name'=>['required', 'unique:sub_categories'],
        ],[
            'category_id.required'=>'Select Your Category',
        ]);
        $subcat=new SubCategory();
        $subcat->category_id=$request->category_id;
        $subcat->subcategory_name=$request->subcategory_name;
        $subcat->save();
        return redirect('subcategory-list')->with('success', 'Insert Successfull');
    }

    function SubCategoryList()
    {
        $last_value=collect(request()->segments())->last();
        $last=Str::of($last_value)->replace('-','-');
        return view('Backend.SubCategory.subcategory-list',[
            'last'  =>$last,
            'subcat'=>SubCategory::paginate(10),
            's_cat' =>SubCategory::count(),
        ]);
    }

    function SubCategoryEdit($id)
    {
        $last_value=collect(request()->segments())->last();
        $last=Str::of($last_value)->replace('-','-');
        return view('Backend.SubCategory.edit',[
            'last'=>$last,
            'category'=>Category::orderBy('category_name', 'asc')->get(),
            'subcategory'=>SubCategory::findOrfail($id),
        ]);
    }
}
