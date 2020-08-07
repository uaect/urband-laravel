<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GalleryCategory;

class GalleryCategoryController extends Controller
{
    public function index(GalleryCategory $model)
    {
        return view('gallerycategories.index', ['categories' => $model->latest()->paginate(15)]);
    }
    public function show(GalleryCategory $categories)
    {
        return view('gallerycategories.show', compact('categories'));
    }
    public function create()
    {
        return view('gallerycategories.create');
    }
    public function store(Request $request, GalleryCategory $model)
    {
        $data = request()->validate([
            'title' =>'required',
        ]);
        try{
        $gallerycategories = auth()->user()->gallerycategory()->create($data);
    } catch (\Exception $ex){
        return back()->withError($ex->getMessage());
    }catch (\Error $ex){
        return back()->withError($ex->getMessage());
    }
        return redirect()->route('gallerycategories.index')->withStatus(__('Gallery Category successfully created.'));
    }
    public function edit(GalleryCategory $gallerycategory)
    {
        return view('gallerycategories.edit', compact('gallerycategory'));
    }
    public function update(Request $request, GalleryCategory  $gallerycategory)
    {
        $data = request()->validate([
            'title' =>'required',
        ]);
        try{
        $gallerycategory->update($data);
    } catch (\Exception $ex){
        return back()->withError($ex->getMessage());
    }catch (\Error $ex){
        return back()->withError($ex->getMessage());
    }
        return redirect()->route('gallerycategories.index')->withStatus(__('Gallery Category successfully updated.'));
    }
    public function destroy(Request $request)
    {
        try{
        GalleryCategory::where('id',$request->item_id)->delete();
    } catch (\Exception $ex){
        return back()->withError($ex->getMessage());
    }catch (\Error $ex){
        return back()->withError($ex->getMessage());
    }
        return 'Gallery successfully deleted.';
    }
}
