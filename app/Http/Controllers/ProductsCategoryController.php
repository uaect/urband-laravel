<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductsCategory;

class ProductsCategoryController extends Controller
{
    public function index(ProductsCategory $model)
    {
        return view('productscategory.index', ['categories' => $model->latest()->paginate(15)]);
    }
    public function show(ProductsCategory $categories)
    {
        return view('productscategory.show', compact('categories'));
    }
    public function create()
    {
        return view('productscategory.create');
    }
    public function store(Request $request, ProductsCategory $model)
    {
        $data = request()->validate([
            'title' =>'required',
        ]);
        try{
        $productscategory = auth()->user()->productcategory()->create($data);
    } catch (\Exception $ex){
        return back()->withError($ex->getMessage());
    }catch (\Error $ex){
        return back()->withError($ex->getMessage());
    }
        return redirect()->route('productscategory.index')->withStatus(__('Product Category successfully created.'));
    }
    public function edit(ProductsCategory $productscategory)
    {
        return view('productscategory.edit', compact('productscategory'));
    }
    public function update(Request $request, ProductsCategory  $productscategory)
    {
        $data = request()->validate([
            'title' =>'required',
        ]);
        try{
        $productscategory->update($data);
    } catch (\Exception $ex){
        return back()->withError($ex->getMessage());
    }catch (\Error $ex){
        return back()->withError($ex->getMessage());
    }
        return redirect()->route('productscategory.index')->withStatus(__('Product Category successfully updated.'));
    }
    public function destroy(Request $request)
    {
        try{
        ProductsCategory::where('id',$request->item_id)->delete();
    } catch (\Exception $ex){
        return back()->withError($ex->getMessage());
    }catch (\Error $ex){
        return back()->withError($ex->getMessage());
    }
        return 'Product successfully deleted.';
    }
}
