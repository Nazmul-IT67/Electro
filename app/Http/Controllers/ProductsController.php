<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Products;
use App\Models\ProductsGallery;
use App\Models\Size;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Nette\Utils\Image;
use Illuminate\Support\Facades\File;

class ProductsController extends Controller
{
    function AddProduct()
    {
        $last_value=collect(request()->segments())->last();
        $last=Str::of($last_value)->replace('-','-');
        return view('Backend.Products.product-add',[
            'last'=>$last,
            'category'=>Category::orderBy('category_name','asc')->get(),
            'color'=>Color::orderBy('color_name','asc')->get(),
            'size'=>Size::orderBy('size_name','asc')->get(),
        ]);
    }

    function InsertProduct(Request $request)
    {
        $request->validate([
            'title'=>['required', 'unique:products'],
            'slug'=>['required'],
            'summery'=>['required'],
            'description'=>['required'],
            'price'=>['required'],
            'thumbnail'=>['required','image'],
        ]);
        $product=new Products;
        $product->product_name=$request->product_name;
        $product->slug=$request->slug;
        $product->category_id=$request->category_id;
        $product->subcategory_id=$request->subcategory_id;
        $product->description=$request->description;
        $product->summery=$request->summery;
        $product->price=$request->price;
        $product->product_thumbnail=$request->product_thumbnail;
        //Thunbnail//
        if($request->hasFile('thumbnail')){
            $image=$request->file('thumbnail');
            $ext=$request->product_title.'.'.$image->getClientOriginalExtension();
            $new=Products::findOrFail($product->id);
            $location=public_path('Product/Thumbnail/'.$new->created_at->format('Y/m/').$new->id.'/');
            File::makeDirectory($location, $mode=0777, true, true);
            Image::make($image)->save($location.$ext);
            $new->thumbnail=$ext;
            $new->save();
        };

        // Miltiple Images
        if($request->hasFile('image')){
            $images=$request->file('image');
            foreach($images as $image){
                $img_ext=$request->title.Str::random(3).'.'.$image->getClientOriginalExtension();
                $path=public_path('Product/Gallerys/'.$product->created_at->format('Y/m/').$product->id.'/');
                File::makeDirectory($path, $mode=0777, true, true);
                Image::make($image)->save($path.$img_ext);
                $img=new ProductsGallery;
                $img->product_gallery=$img_ext;
                $img->product_id=$product->id;
                $img->save();
            }
        }
        // Product Attribute
        $color_id=$request->color_id;
        $size_id=$request->size_id;
        $quantity=$request->quantity;
        $product_price=$request->product_price;

        for($i=0; $i<count($color_id); $i++){
            $data=[
                'product_id'=>$product->id,
                'color_id'=>$color_id[$i],
                'size_id'=>$size_id[$i],
                'quantity'=>$quantity[$i],
                'product_price'=>$product_price[$i],
            ];
            DB::table('product_attributes')->insert($data);
        }
        return redirect('product-list')->with('message', 'Product Add Successfull!');
    }
    // Product Subcategoey
    function SubCat($id){
        $sub_cat=SubCategory::where('category_id', $id)->get();
        return response()->json($sub_cat);
    }
}
