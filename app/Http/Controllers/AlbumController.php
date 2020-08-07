<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Album;
use App\AlbumArtistRelation;
use App\AlbumFiles;
use App\Artist;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use File;

class AlbumController extends Controller
{
    public function index(Album $model)
    {
        return view('albums.index', ['albums' => $model->where(array('status'=>1))->latest()->paginate(15)]);
    }
    public function show(Album $album)
    {
        $artist = Artist::all();
        return view('albums.show', compact('album','artist'));
    }
    public function create()
    {
        $artist = Artist::all();
        return view('albums.create', compact('artist'));
    }
    public function store(Request $request, Album $model)
    {
        $data = request()->validate([
            'title' =>'required',
            'description' => '',
            'image' => 'required',
        ]);
        try{
        $page = ['description'=>$request->input('description')];
        $data = array_merge($data,$page??[]);
        if(request('image')){
            $imagePath = request('image')->store('uploads','public');
            $image = Image::make(public_path("storage/{$imagePath}"));
            $image->save();
            $imageArray = ['image'=>$imagePath ];
        }
        //print_r($request->addmore);exit;
        $addmore = request()->validate([
            'addmore.*.artist' => 'required',
        ]);
        $album = auth()->user()->album()->create(array_merge($data,$imageArray??[]));
        foreach ($request->addmore as $key => $value) {
            if(@$value['file']){
            $uniqueid = uniqid();
            $Document_Path = storage_path('app/public/audio/');
            File::isDirectory($Document_Path) or File::makeDirectory($Document_Path, 0777, true, true);
            $extension = $value['file']->getClientOriginalExtension();
            $image = $value['file'];
            $newname = 'track_'.Carbon::now()->format('Ymd').'_'.$uniqueid.'.'.$extension;
            $audiopath = 'audio/'.$newname;
            $upload = $image->storeAs('public/audio',$newname);

            // $uniqueid = uniqid();
            // $original_name = $value['file']->getClientOriginalName();
            // $size = $value['file']->getSize();
            // $extension = $value['file']->getClientOriginalExtension();
            // $filename = 'track_'.Carbon::now()->format('Ymd').'_'.$uniqueid.'.'.$extension;
            // $audiopath = 'audio/'.$filename;
            // $path = $value['file']->storeAs('public/audio/',$filename);
            // $all_audios = $audiopath;
            $files = [
                'title'=>$value['title'],
                'artist_id'=>$value['artist'],
                'file'=>$audiopath,
                'album_id'=>$album->id
            ];
            AlbumFiles::create($files);
            $relations = [
                'artist_id'=>$value['artist'],
                'album_id'=>$album->id
            ];
            AlbumArtistRelation::create($relations);

        }else{
            $addmore = request()->validate([
                'addmore.*.file' => 'required',
            ]);
        }
        }
    } catch (\Exception $ex){
        return back()->withError($ex->getMessage());
    }catch (\Error $ex){
        return back()->withError($ex->getMessage());
    }
        return redirect()->route('album.index')->withStatus(__('Album successfully created.'));
    }
    public function edit(Album $album)
    {
        $artist = Artist::all();
        return view('albums.edit', compact('album','artist'));
    }
    public function update(Request $request, Album $album)
    {
        $data = request()->validate([
            'title' =>'required',
            'description' => '',
        ]);
        try{
        $page = ['description'=>$request->input('description')];
        $data = array_merge($data,$page??[]);
        if(request('image')){
            $imagePath = request('image')->store('uploads','public');
            $image = Image::make(public_path("storage/{$imagePath}"));
            $image->save();
            $imageArray = ['image'=>$imagePath ];
        }
        $album->update(array_merge($data,$imageArray??[]));
        //$delete = AlbumFiles::where('album_id',$album->id)->delete();
        //$delete = AlbumArtistRelation::where('album_id',$album->id)->delete();
        $g_files = AlbumFiles::where('album_id',$album->id)->get();
        if(!$g_files){
            $addmore = request()->validate([
                'addmore.*.file' => 'required',
            ]);
        }else{
        foreach ($request->addmore as $key => $value) {
            if(@$value['file']){
            $uniqueid = uniqid();
            $Document_Path = storage_path('app/public/audio/');
            File::isDirectory($Document_Path) or File::makeDirectory($Document_Path, 0777, true, true);
            $extension = $value['file']->getClientOriginalExtension();
            $image = $value['file'];
            $newname = 'track_'.Carbon::now()->format('Ymd').'_'.$uniqueid.'.'.$extension;
            $audiopath = 'audio/'.$newname;
            $upload = $image->storeAs('public/audio',$newname);
            $files = [
                'title'=>$value['title'],
                'artist_id'=>$value['artist'],
                'file'=>$audiopath,
                'album_id'=>$album->id
            ];
            AlbumFiles::create($files);
            $relations = [
                'artist_id'=>$value['artist'],
                'album_id'=>$album->id
            ];
            AlbumArtistRelation::create($relations);
        }
        }
    }

} catch (\Exception $ex){
    return back()->withError($ex->getMessage());
}catch (\Error $ex){
    return back()->withError($ex->getMessage());
}
        return redirect()->route('album.index')->withStatus(__('Album successfully updated.'));
    }
    public function destroy(Request $request)
    {
        $data = ['status'=>0];
        try{
        Album::where('id',$request->item_id)->update($data);
    } catch (\Exception $ex){
        return back()->withError($ex->getMessage());
    }catch (\Error $ex){
        return back()->withError($ex->getMessage());
    }
        return 'Album successfully deleted.';
    }
    public function destroyfile(Request $request)
    {
        try{
        $delete = AlbumFiles::findOrFail($request->item_id);
        $image_path = public_path().'/storage/'.$delete->file;
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
        AlbumFiles::where('id',$request->item_id)->delete();
    } catch (\Exception $ex){
        return back()->withError($ex->getMessage());
    }catch (\Error $ex){
        return back()->withError($ex->getMessage());
    }
        return 'Album successfully deleted.';
    }
}
