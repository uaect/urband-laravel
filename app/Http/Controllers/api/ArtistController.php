<?php
namespace App\Http\Controllers\api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Artist;
use App\Album;
use App\AlbumArtistRelation;
use App\AlbumFiles;
use Illuminate\Support\Facades\URL;

class ArtistController extends Controller
{
        public function index(Request $request)
    {
        $page = $request->json('page');
        $perpage=15;
        if(!$page) $page=1;
        $offset=$perpage*($page-1);
        $limit=$perpage;
        $res=DB::table('artists')->where(array('status'=>1))->offset($offset)->limit($limit)->latest()->get();
        foreach($res as $row){
            $album = DB::table('album')
            ->leftJoin('album_artist_relation', 'album_artist_relation.album_id', '=', 'album.id')
            ->leftJoin('album_files', 'album_files.album_id', '=', 'album.id')
            ->where('album.user_id',$row->id)
            ->get();
            $row->album=$album;
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
