<?php
namespace App\Http\Controllers\api;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Album;
use App\Http\Resources\Album as AlbumResource;
use Illuminate\Support\Facades\URL;

class AlbumController extends Controller
{
        public function index(Request $request)
    {
        $page = $request->json('page');
        $perpage=27;
        if(!$page) $page=1;
        $offset=$perpage*($page-1);
        $limit=$perpage;
        $res=DB::table('album')->where('status',1)->offset($offset)->limit($limit)->latest()->get();
        foreach($res as $row){
            $tracks = DB::table('album_files')
            ->leftJoin('artists', 'artists.id', '=', 'album_files.artist_id')
            ->where('album_files.album_id',$row->id)
            ->get();
            $row->tracks=$tracks;
            $row->image_url = URL::to('/storage/');
        }

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
        $albumid = $request->json('albumid');
        $artistid = $request->json('artistid');
        $res = [];
        if($artistid){
            $res = DB::table('album')
        ->leftJoin('album_artist_relation', 'album_artist_relation.album_id', '=', 'album.id')
        ->where(array('album_artist_relation.artist_id'=>$artistid,'status'=>1))
        ->first();
        }else if($albumid){
            $res = DB::table('album')
        ->leftJoin('album_artist_relation', 'album_artist_relation.album_id', '=', 'album.id')
        ->where(array('album.id'=>$albumid,'status'=>1))
        ->first();
        }
        if($res){
            $tracks = DB::table('album_files')
            ->leftJoin('artists', 'artists.id', '=', 'album_files.artist_id')
            ->where('album_files.album_id',$res->album_id)
            ->limit(25)
            ->get();
            $res->tracks=$tracks;
            $relatedAlbums = array();
            $before = DB::table('album as A')
            ->select('A.*')
            ->leftJoin('album_artist_relation as B', 'B.album_id', '=', 'A.id')
            ->where('B.artist_id',$res->artist_id)
            ->where('A.id','!=',$res->album_id)
            ->where('A.status',1)
            ->groupBy('A.id')
            ->limit(10)
            ->get()
            ->toArray();
            $after = DB::table('album as A')
            ->select('A.*')
            ->leftJoin('album_artist_relation as B', 'B.album_id', '=', 'A.id')
            ->where('B.artist_id','!=',$res->artist_id)
            ->where('A.id','!=',$res->album_id)
            ->where('A.status',1)
            ->groupBy('A.id')
            ->limit(10)
            ->get()
            ->toArray();
            $relatedAlbums = array_merge($before,$after);
            $res->relatedAlbums = $relatedAlbums;
            $res->image_url = URL::to('/storage/');
        }
        if($res){
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
                'result' => 'Unfounded alabum or Emptey table'
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
