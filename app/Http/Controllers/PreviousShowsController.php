<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PreviousShows;
use Intervention\Image\Facades\Image;

class PreviousShowsController extends Controller
{
    public function index(PreviousShows $model)
    {
        return view('previous_shows.index', ['previous_shows' => $model->latest()->paginate(15)]);
    }
    public function create()
    {
        return view('previous_shows.create');
    }
    public function createspotlight()
    {
        return view('previous_shows.createspotlight');
    }
    public function insert_previous_shows(Request $request, PreviousShows $model)
    {
        $result = $model->where('type','Previous Show')->first();
        $data = request()->validate([
            'title' => 'required',
            'video_url' => 'required'
        ]);
    //     if($result){
    //     $images = ['images'=> implode(",", $request->input('document')),'type'=>'Previous Show'];
    //     $data = array_merge($data,$images??[]);
    //     $result->update(array_merge($data));
    // }else{
        try{
        if(request('document')){
            $images = ['images'=> implode(",", $request->input('document')),'type'=>'Previous Show'];
            $data = array_merge($data,$images??[]);
        }
        auth()->user()->previousshows()->create(array_merge($data));
    } catch (\Exception $ex){
        return back()->withError($ex->getMessage());
    }catch (\Error $ex){
        return back()->withError($ex->getMessage());
    }
    //}
        return redirect()->route('previous_shows.index')->with('success', __('Settings successfully created.'));
    }
    public function insert_spotlight(Request $request, PreviousShows $model)
    {
        $result = $model->where('type','Spotlight')->first();
        $data = request()->validate([
            'title' => 'required',
            'video_url' => 'required'
        ]);
    //     if($result){
    //     $images = ['images'=> implode(",", $request->input('document')),'type'=>'Spotlight'];
    //     $data = array_merge($data,$images??[]);
    //     $result->update(array_merge($data));
    // }else{
        try{
        if(request('document')){
            $images = ['images'=> implode(",", $request->input('document')),'type'=>'Spotlight'];
            $data = array_merge($data,$images??[]);
        }
        auth()->user()->previousshows()->create(array_merge($data));
    } catch (\Exception $ex){
        return back()->withError($ex->getMessage());
    }catch (\Error $ex){
        return back()->withError($ex->getMessage());
    }
    //}
        return redirect()->route('previous_shows.index')->with('success', __('Settings successfully created.'));
    }
    public function storeMedia(Request $request)
    {
        $imagePath = $request->file('file')->store('uploads','public');
        $image = Image::make(public_path("storage/{$imagePath}"));
        $image->save();
        $file = $request->file('file');
        return response()->json([
            'name'          => $imagePath,
            'original_name' => $imagePath,
        ]);
    }
    public function destroy(Request $request)
    {
        try{
        $shows = PreviousShows::findOrFail($request->item_id);
        if($shows){
            $images = explode(",", $shows->images);
            foreach($images as $image){
                unlink(public_path("storage/{$image}"));
            }
        }
        PreviousShows::where('id',$request->item_id)->delete();
    } catch (\Exception $ex){
        return back()->withError($ex->getMessage());
    }catch (\Error $ex){
        return back()->withError($ex->getMessage());
    }
        return 'Shows successfully deleted.';
    }
}
