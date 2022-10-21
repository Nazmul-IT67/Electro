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
            'subcat'=>SubCategory::orderBy('subcategory_name', 'asc')->paginate(10),
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

    function UpdateData(Request $request)
    {
        $request->validate([
            'subcategory_name'=>['required'],
            'category_id'=>['required'],
        ],[
            'category_id.required'=>'Please Select Your Category',
        ]);
        $subcategory=SubCategory::findOrFail($request->subcategory_id);
        $subcategory->subcategory_name=$request->subcategory_name;
        $subcategory->category_id=$request->category_id;
        $subcategory->save();
        return redirect('subcategory-list')->with('success', 'Updated Successfull');
    }

    function SubCategoryDelete($id)
    {
        SubCategory::findOrFail($id)->delete();
        return redirect('subcategory-list')->with('success', 'Deleted Successfull');
    }

    function TrashData(){
        $last_value=collect(request()->segments())->last();
        $last=Str::of($last_value)->replace('-','');
        return view('Backend.Subcategory.trash-data',[
            'subtrash'=>SubCategory::onlyTrashed()->paginate(10),
            'sub_count'=>$sub_count=SubCategory::onlyTrashed()->count(),
            'last'=>$last,
        ]);
    }

    function UndoData($id){
        SubCategory::onlyTrashed()->findOrFail($id)->restore();
        return redirect('subcategory-list')->with('success', 'Category Restore Successfull');
    }

    function DeleteData($id){
        SubCategory::onlyTrashed()->findOrFail($id)->forceDelete();
        return redirect('subcategory-list')->with('success', 'Category Permanent Delete Successfull');
    }
}
