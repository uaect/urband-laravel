<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App\ProductsCategory;
use App\ProductsImages;
use Intervention\Image\Facades\Image;
use File;

class ProductsController extends Controller
{
    public function index(Products $model)
    {
        //dd($model->active()->with('category')->latest()->paginate(15));
        return view('products.index', ['products' => $model->active()->with('category')->latest()->paginate(15)]);
    }
    public function show($products)
    {
        $products = Products::findOrFail($products);
        return view('products.show', compact('products'));
    }
    public function create()
    {
        $category = ProductsCategory::all();
        return view('products.create', compact('category'));
    }
    public function store(Request $request, Products $model)
    {
        $data = request()->validate([
            'title' =>'required',
            'price' => 'required',
            'category' => 'required',
            'description' => '',
        ]);
        try{
        $products_images = request()->validate([
            'document' => 'required',
        ]);
        $products = auth()->user()->product()->create(array_merge($data));
        $images = $request->input('document', []);
        if($images){
            foreach($images as $val){
            $imageArray = [
                'image'=>$val,
                'products_id'=>$products->id
            ];
            ProductsImages::create($imageArray);
            }
        }
    } catch (\Exception $ex){
        return back()->withError($ex->getMessage());
    }catch (\Error $ex){
        return back()->withError($ex->getMessage());
    }
        return redirect()->route('products.index')->withStatus(__('Products successfully created.'));
    }
    public function storeMedia(Request $request)
    {
        $imagePath = $request->file('file')->store('products','public');
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(830,830);
        $image->save();
        $file = $request->file('file');
        return response()->json([
            'name'          => $imagePath,
            'original_name' => $imagePath,
        ]);
    }
    public function edit($products)
    {
        $products = Products::find($products);
        $category = ProductsCategory::all();
        return view('products.edit', compact('products','category'));
    }
    public function update(Request $request,$products)
    {
        $products = Products::find($products);
        $data = request()->validate([
            'title' =>'required',
            'price' => 'required',
            'category' => 'required',
            'description' => '',
        ]);
        try{
        $images = $request->input('document', []);

        if($images){
            $products->update($data);
            $delete_files = $request->input('delete_files', []);
            foreach($delete_files as $val){
            $image_path = public_path().'/storage/'.$val;
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }
            $Files = ProductsImages::where('products_id',$products->id)->delete();
            foreach($images as $val){
            $imageArray = [
                'image'=>$val,
                'products_id'=>$products->id
            ];
            ProductsImages::create($imageArray);
            }
        }else{
            $products_images = request()->validate([
                'document' => 'required',
            ]);
        }
    } catch (\Exception $ex){
        return back()->withError($ex->getMessage());
    }catch (\Error $ex){
        return back()->withError($ex->getMessage());
    }
        return redirect()->route('products.index')->withStatus(__('Products successfully updated.'));
    }
    public function destroy(Request $request)
    {
        try{
        $data = ['status'=>0];
        Products::where('id',$request->item_id)->update($data);
    } catch (\Exception $ex){
        return back()->withError($ex->getMessage());
    }catch (\Error $ex){
        return back()->withError($ex->getMessage());
    }
        return 'Products successfully deleted.';
    }
}
