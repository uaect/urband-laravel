<?php
namespace App\Http\Controllers\api;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events;
use App\Http\Resources\Events as EventsResource;
use App\Event;
use Illuminate\Support\Facades\URL;

class EventsController extends Controller
{
        public function index(Request $request)
    {
        $page = $request->json('page');
        $perpage=27;
        if(!$page) $page=1;
        $offset=$perpage*($page-1);
        $limit=$perpage;
        $res=DB::table('events')->where(array('status'=>1))->offset($offset)->limit($limit)->latest()->get();
        if(count($res) > 0){
            $result = array(
                'success' => true,
                'result' => $res,
                'image_url' => URL::to('/storage/')
            );
            return response($result)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Headers' => 'Origin, X-Requested-With, Content-Type, Accept',
            ]);
        }else{
            $result = array(
                'success' => false,
                'result' => 'Emptey table'
            );
            return response($result)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Headers' => 'Origin, X-Requested-With, Content-Type, Accept',
            ]);
        }
    }

        public function ticketevent(Request $request)
    {
        $page = $request->json('page');
        $perpage=27;
        if(!$page) $page=1;
        $offset=$perpage*($page-1);
        $limit=$perpage;
        $Date = date('Y-m-d');
        $res=DB::table('events')->where(array('status'=>1))->whereDate('date_to', '>', $Date)->offset($offset)->limit($limit)->latest()->get();
        if(count($res) > 0){
            $result = array(
                'success' => true,
                'result' => $res,
                'image_url' => URL::to('/storage/')
            );
            return response($result)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Headers' => 'Origin, X-Requested-With, Content-Type, Accept',
            ]);
        }else{
            $result = array(
                'success' => false,
                'result' => 'Emptey table'
            );
            return response($result)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Headers' => 'Origin, X-Requested-With, Content-Type, Accept',
            ]);
        }
    }

        public function details(Request $request)
    {
        $eventid = $request->json('eventid');
        $res = DB::table('events')->where('id',$eventid)->first();
        $artist = DB::table('artists')
        ->leftJoin('event_artist', 'event_artist.artist_id', '=', 'artists.id')
        ->where(array('event_artist.event_id'=>$eventid,'artists.status'=>1))
        ->get();
        $packages = DB::table('event_packages')->where(array('event_id'=>$eventid))->get();
        if($res){
            $result = array(
                'success' => true,
                'result' => $res,
                'artists' => $artist,
                'packages' => $packages,
                'image_url' => URL::to('/storage/')
            );
            return response($result)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Headers' => 'Origin, X-Requested-With, Content-Type, Accept',
            ]);
        }else{
            $result = array(
                'success' => false,
                'result' => 'no result'
            );
            return response($result)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Headers' => 'Origin, X-Requested-With, Content-Type, Accept',
            ]);
        }
    }

}
