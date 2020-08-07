<?php

namespace App\Http\Controllers;

use App\Artist;
use Illuminate\Http\Request;
use App\Event;
use App\EventPackages;
use App\EventArtistRelation;
use App\User;
use Intervention\Image\Facades\Image;
use File;

class EventController extends Controller
{
    public function index(Event $model)
    {
        return view('events.index', ['events' => $model->where(array('status'=>1))->latest()->paginate(15)]);
    }
    public function show(Event $event)
    {
        $artist = Artist::all();
        return view('events.show', compact('event','artist'));
    }
    public function create()
    {
        $artist = Artist::all();
        return view('events.create', compact('artist'));
    }
    public function store(Request $request, Event $model)
    {
        $data = request()->validate([
            'title' =>'required',
            'headline' => '',
            'location' => '',
            'date_from' => 'required',
            'date_to' => 'required',
            'time_from' => 'required',
            'time_to' => 'required',
            'tickets' => 'required',
            'description' => '',
        ]);
        $event_images = request()->validate([
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
        $addmore = request()->validate([
            'addmore.*.artist' => 'required',
        ]);
        if($request->input('tickets')==1){
        $addmore = request()->validate([
            'packages.*.package_name' => 'required',
        ]);
        }
        $event = auth()->user()->event()->create(array_merge($data,$imageArray??[]));
        foreach ($request->addmore as $key => $value) {
            $artist = [
                'artist_id'=>$value['artist'],
                'from'=>$value['from'],
                'to'=>$value['to'],
                'band_name'=>$value['band_name'],
                'duration'=>$value['duration'],
                'event_id'=>$event->id
            ];
            EventArtistRelation::create($artist);
    }
    if($request->input('tickets')==1){
        foreach ($request->packages as $key => $value) {
            $packages = [
                'package_name'=>$value['package_name'],
                'tickets_available'=>$value['tickets_available'],
                'price'=>$value['price'],
                'event_id'=>$event->id
            ];
            EventPackages::create($packages);
        }
    }
    } catch (\Exception $ex){
        return back()->withError($ex->getMessage());
    }catch (\Error $ex){
        return back()->withError($ex->getMessage());
    }
        return redirect()->route('event.index')->withStatus(__('Event successfully created.'));
    }
    public function edit(Event $event)
    {
        $artist = Artist::all();
        return view('events.edit', compact('event','artist'));
    }
    public function update(Request $request, Event  $event)
    {
        $data = request()->validate([
            'title' =>'required',
            'headline' => '',
            'location' => '',
            'date_from' => 'required',
            'date_to' => 'required',
            'time_from' => 'required',
            'time_to' => 'required',
            'tickets' => 'required',
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
        $addmore = request()->validate([
            'addmore.*.artist' => 'required',
        ]);
        if($request->input('tickets')==1){
        $addmore = request()->validate([
            'packages.*.package_name' => 'required',
        ]);
        }
        $event->update(array_merge($data,$imageArray??[]));
        $delete = EventArtistRelation::where('event_id',$event->id)->delete();
        foreach ($request->addmore as $key => $value) {
            $artist = [
                'artist_id'=>$value['artist'],
                'from'=>$value['from'],
                'to'=>$value['to'],
                'band_name'=>$value['band_name'],
                'duration'=>$value['duration'],
                'event_id'=>$event->id
            ];
            EventArtistRelation::create($artist);
        }
        $delete = EventPackages::where('event_id',$event->id)->delete();
        if($request->input('tickets')==1){
        foreach ($request->packages as $key => $value) {
            $packages = [
                'package_name'=>$value['package_name'],
                'tickets_available'=>$value['tickets_available'],
                'price'=>$value['price'],
                'event_id'=>$event->id
            ];
            EventPackages::create($packages);
        }
        }
    } catch (\Exception $ex){
        return back()->withError($ex->getMessage());
    }catch (\Error $ex){
        return back()->withError($ex->getMessage());
    }
        return redirect()->route('event.index')->withStatus(__('Event successfully updated.'));
    }
    public function destroy(Request $request)
    {
        try{
        $data = ['status'=>0];
        Event::where('id',$request->item_id)->update($data);
    } catch (\Exception $ex){
        return back()->withError($ex->getMessage());
    }catch (\Error $ex){
        return back()->withError($ex->getMessage());
    }
        return 'Event successfully deleted.';
    }
}
