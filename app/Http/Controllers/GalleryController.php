<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gallery;
use App\GalleryCategory;
use App\GalleryFiles;
use Intervention\Image\Facades\Image;
use File;
class GalleryController extends Controller
{
    public function index(Gallery $model)
    {
        return view('gallery.index', ['galleries' => $model->active()->latest()->paginate(15)]);
    }
    public function show($gallery)
    {
        $gallery = Gallery::findOrFail($gallery);
        return view('gallery.show', compact('gallery'));
    }
    public function create()
    {
        $category = GalleryCategory::all();
        return view('gallery.create', compact('category'));
    }
    public function store(Request $request, Gallery $model)
    {
        $data = request()->validate([
            'title' =>'required',
            'sub_title' => '',
            'category' => 'required',
        ]);
        try{
        $gallery_images = request()->validate([
            'document' => 'required',
        ]);
        $gallery = auth()->user()->gallery()->create(array_merge($data));
        $images = $request->input('document', []);
        if($images){
            foreach($images as $val){
            $imageArray = [
                'image'=>$val,
                'gallery_id'=>$gallery->id
            ];
            GalleryFiles::create($imageArray);
            }
        }
    } catch (\Exception $ex){
        return back()->withError($ex->getMessage());
    }catch (\Error $ex){
        return back()->withError($ex->getMessage());
    }
        return redirect()->route('gallery.index')->withStatus(__('Gallery successfully created.'));
    }
    public function storeMedia(Request $request)
    {
        $imagePath = $request->file('file')->store('uploads','public');
        $image = Image::make(public_path("storage/{$imagePath}"));
        $image->save();
        $file = $request->file('file');
        // $path = storage_path('tmp/uploads');
        // if (!file_exists($path)) {
        //     mkdir($path, 0777, true);
        // }
        // $file = $request->file('file');
        // $name = uniqid() . '_' . trim($file->getClientOriginalName());
        // $file->move($path, $name);
        return response()->json([
            'name'          => $imagePath,
            'original_name' => $imagePath,
        ]);
    }
    public function edit($gallery)
    {
        $gallery = Gallery::find($gallery);
        $category = GalleryCategory::all();
        return view('gallery.edit', compact('gallery','category'));
    }
    public function update(Request $request,$gallery)
    {
        $gallery = Gallery::find($gallery);
        $data = request()->validate([
            'title' =>'required',
            'sub_title' => '',
            'category' => 'required',
        ]);
        try{
        $images = $request->input('document', []);

        if($images){
            $gallery->update($data);
            $delete_files = $request->input('delete_files', []);
            foreach($delete_files as $val){
            $image_path = public_path().'/storage/'.$val;
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
            }
            $Files = GalleryFiles::where('gallery_id',$gallery->id)->delete();
            foreach($images as $val){
            $imageArray = [
                'image'=>$val,
                'gallery_id'=>$gallery->id
            ];
            GalleryFiles::create($imageArray);
            }
        }else{
            $gallery_images = request()->validate([
                'document' => 'required',
            ]);
        }
    } catch (\Exception $ex){
        return back()->withError($ex->getMessage());
    }catch (\Error $ex){
        return back()->withError($ex->getMessage());
    }
        return redirect()->route('gallery.index')->withStatus(__('Gallery successfully updated.'));
    }
    public function destroy(Request $request)
    {
        try{
        $data = ['status'=>0];
        Gallery::where('id',$request->item_id)->update($data);
    } catch (\Exception $ex){
        return back()->withError($ex->getMessage());
    }catch (\Error $ex){
        return back()->withError($ex->getMessage());
    }
        return 'Gallery successfully deleted.';
    }
}
