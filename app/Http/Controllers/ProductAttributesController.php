<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductAttributes;

class ProductAttributesController extends Controller
{
    public function index(ProductAttributes $model)
    {
        return view('productattributes.index', ['categories' => $model->latest()->paginate(15)]);
    }
    public function show(ProductAttributes $categories)
    {
        return view('productattributes.show', compact('categories'));
    }
    public function create()
    {
        return view('productattributes.create');
    }
    public function store(Request $request, ProductAttributes $model)
    {
        $data = request()->validate([
            'title' =>'required',
            'title' =>'required',
        ]);
        $productattributes = auth()->user()->productattribute()->create($data);
        return redirect()->route('productattributes.index')->withStatus(__('Product Category successfully created.'));
    }
    public function edit(ProductAttributes $productattributes)
    {
        return view('productattributes.edit', compact('productattributes'));
    }
    public function update(Request $request, ProductAttributes  $productattributes)
    {
        $data = request()->validate([
            'title' =>'required',
        ]);
        $productattributes->update($data);
        return redirect()->route('productattributes.index')->withStatus(__('Product Category successfully updated.'));
    }
    public function destroy(Request $request)
    {
        ProductAttributes::where('id',$request->item_id)->delete();
        return 'Product successfully deleted.';
    }
}
