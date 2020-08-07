<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Artist;
use Intervention\Image\Facades\Image;

class ArtistController extends Controller
{
    public function index(Artist $model)
    {
        return view('artists.index', ['artists' => $model->where(array('status'=>1))->latest()->paginate(15)]);
    }
    public function show(Artist $artist)
    {
        return view('artists.show', compact('artist'));
    }
    public function create()
    {
        return view('artists.create');
    }
    public function store(Request $request, Artist $model)
    {
        $data = request()->validate([
            'name' =>'required',
            'genre' =>'required',
            'about' => '',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:10248',
        ]);
        try{
        $page = ['about'=>$request->input('about')];
        $data = array_merge($data,$page??[]);
        if(request('image')){
            $imagePath = request('image')->store('uploads','public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(440,440);
            $image->save();
            $imageArray = ['image'=>$imagePath ];
        }
        auth()->user()->artist()->create(array_merge($data,$imageArray??[]));
        } catch (\Exception $ex){
            return back()->withError($ex->getMessage());
        }catch (\Error $ex){
            return back()->withError($ex->getMessage());
        }
        return redirect()->route('artist.index')->withStatus(__('Artist successfully created.'));
    }
    public function edit(Artist $artist)
    {
        return view('artists.edit', compact('artist'));
    }
    public function update(Request $request, Artist $artist)
    {
        $data = request()->validate([
            'name' =>'required',
            'genre' =>'required',
            'about' => '',
        ]);
        try{
        $page = ['about'=>$request->input('about')];
        $data = array_merge($data,$page??[]);
        if(request('image')){
            $imagePath = request('image')->store('uploads','public');
            $image = Image::make(public_path("storage/{$imagePath}"));
            $image->save();
            $imageArray = ['image'=>$imagePath ];
        }
        $artist->update(array_merge($data,$imageArray??[]));
        } catch (\Exception $ex){
            return back()->withError($ex->getMessage());
        }catch (\Error $ex){
            return back()->withError($ex->getMessage());
        }
        return redirect()->route('artist.index')->withStatus(__('Artist successfully updated.'));
    }
    public function destroy(Request $request)
    {
        try{
        $data = ['status'=>0];
        Artist::where('id',$request->item_id)->update($data);
        } catch (\Exception $ex){
            return back()->withError($ex->getMessage());
        }catch (\Error $ex){
            return back()->withError($ex->getMessage());
        }
        return 'Artist successfully deleted.';
    }
}
