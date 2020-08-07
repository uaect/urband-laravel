<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\ContentManagement;
use File;
class ClientFeedbackController extends Controller
{
    public function index(ContentManagement $model)
    {
        return view('clientsfeedback.index', ['clientsfeedback' => $model->where(array('page'=>'Clients Feedback','status'=>1))->paginate(15)]);
    }
    public function create()
    {
        return view('clientsfeedback.create');
    }
    public function edit(ContentManagement $model,$id)
    {
        $clientsfeedback = $model->findOrFail($id);
        return view('clientsfeedback.edit', compact('clientsfeedback'));
    }
    public function store(Request $request, ContentManagement $model)
    {
        $data = request()->validate([
            'title' =>'',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:10248',
            'description' => '',
        ]);
        try{
        $page = ['page'=>'Clients Feedback','description'=>$request->input('description')];
        $data = array_merge($data,$page??[]);
        if(request('image')){
            $imagePath = request('image')->store('uploads','public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(300,300);
            $image->save();
            $imageArray = ['image'=>$imagePath ];
        }
        auth()->user()->content()->create(array_merge($data,$imageArray??[]));
    } catch (\Exception $ex){
        return back()->withError($ex->getMessage());
    }catch (\Error $ex){
        return back()->withError($ex->getMessage());
    }
        return redirect()->route('clientfeedback.index')->withStatus(__('Client successfully created.'));
    }
    public function update(Request $request, ContentManagement $model,$id)
    {
        $clientsfeedback = $model->findOrFail($id);
        $data = request()->validate([
            'title' =>'',
            'image' => 'image|mimes:jpeg,png,jpg|max:10248',
            'description' => '',
        ]);
        try{
        $page = ['description'=>$request->input('description')];
        $data = array_merge($data,$page??[]);
        if(request('image')){
            $imagePath = request('image')->store('uploads','public');
            $image = Image::make(public_path("storage/{$imagePath}"));
            $image->save();
            $last = $model->findOrFail($id);
            $image_path = public_path().'/storage/'.$last->image;
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            $imageArray = ['image'=>$imagePath ];
        }
        $clientsfeedback->update(array_merge($data,$imageArray??[]));
    } catch (\Exception $ex){
        return back()->withError($ex->getMessage());
    }catch (\Error $ex){
        return back()->withError($ex->getMessage());
    }
        return redirect()->route('clientfeedback.index')->withStatus(__('Client successfully updated.'));
    }
    public function show(ContentManagement $model,$id)
    {
        $clientsfeedback = $model->findOrFail($id);
        return view('clientsfeedback.show',  compact('clientsfeedback'));
    }
    public function destroy(Request $request)
    {
        try{
        $data = ['status'=>0];
        ContentManagement::where('id',$request->item_id)->update($data);
    } catch (\Exception $ex){
        return back()->withError($ex->getMessage());
    }catch (\Error $ex){
        return back()->withError($ex->getMessage());
    }
        return 'Client successfully deleted.';
    }
}
