<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class CategoryController extends Controller
{
    function AddCategory()
    {
        $last_value=collect(request()->segments())->last();
        $last=Str::of($last_value)->replace('-','-');
        return view('Backend.Category.add-category', compact('last'));
    }

    function CategoryPost(Request $request)
    {
        $request->validate([
            'category_name'=>['required','unique:categories'],
            'checkbox'     =>['required'],
        ]);
        $category=new Category();
        $category->category_name=$request->category_name;
        $category->save();
        return redirect('category-list')->with('success','Category Add Successfull !!');
    }

    function CategoryList()
    {
        $last_value=collect(request()->segments())->last();
        $last=Str::of($last_value)->replace('-','-');
        return view('Backend.Category.category-list',[
            'category'=>Category::paginate(10),
            'last'    =>$last,
            'cat_count'=>$cat_count=Category::count(),
        ]);
    }

    function CategoryEdit($id)
    {
        $last_value=collect(request()->segments())->last();
        $last=Str::of($last_value)->replace('-','-');
        return view('Backend.Category.category-edit',[
            'category'=>Category::findOrFail($id),
            'last'=>$last,
        ]);
    }

    function CategoryUpdate(Request $request)
    {
        $request->validate([
            'category_name'=>['required', 'min:5', 'unique:categories'],
            'checkbox'     =>['required'],
        ]);
        Category::findOrFail($request->category_id)->update([
            'category_name'=>$request->category_name,
            'updated_at'=>Carbon::now(),
        ]);
        return redirect('category-list')->with('success', 'Category Updated Successfull');
    }

    function CategoryTrash($id)
    {
        Category::findOrFail($id)->delete();
        return redirect('category-list')->with('success', 'Category Delete Successfull !!');
    }

    function CategoryTrashList()
    {
        $last_value=collect(request()->segments())->last();
        $last=Str::of($last_value)->replace('-','-');
        return view('Backend.Category.trashlist',[
            'last'=>$last,
            'category'=>Category::onlyTrashed()->paginate(10),
            't_count'=>$t_count=Category::onlyTrashed()->count(),
        ]);
    }

    function Restor($id)
    {
        Category::onlyTrashed()->findOrFail($id)->restore();
        return redirect('category-list')->with('success', 'Category Reset Successfull !!');
    }

    function Delete($id)
    {
        Category::onlyTrashed()->findOrFail($id)->forceDelete();
        return redirect('trashlist')->with('success', 'Category Delete Successfull !!');
    }
}
