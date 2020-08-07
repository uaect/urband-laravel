<?php
namespace App\Http\Controllers\api;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Gallery;
use App\GalleryCategory;
use App\GalleryFiles;
use Illuminate\Support\Facades\URL;

class GalleryController extends Controller
{
        public function category(Request $request)
    {
        $page = $request->json('page');
        $perpage=5;
        if(!$page) $page=1;
        $offset=$perpage*($page-1);
        $limit=$perpage;
        $res = DB::table('gallery_categories')->offset($offset)->limit($limit)->latest()->get();
        foreach($res as $cat){
            $gallery=DB::table('galleries')->where(array('category'=>$cat->title,'status'=>1))->get();
            $cat->gallery=$gallery?$gallery:array();
            foreach($cat->gallery as $gal){
                $files=DB::table('gallery_files')->where('gallery_id',$gal->id)->get();
                $gal->files=$files?$files:array();
                $gal->image_url = URL::to('/storage/');
            }
        }

        if(count($res) > 0){
            $result = array(
                'success' => true,
                'result' => $res
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
                'result' => 'Emptey table (gallery / category)'
            );
            return response($result)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Headers' => 'Origin, X-Requested-With, Content-Type, Accept',
            ]);
        }
    }

    //     public function gallery(Request $request)
    // {
    //     $page = $request->json('page');
    //     $perpage=15;
    //     if(!$page) $page=1;
    //     $offset=$perpage*($page-1);
    //     $limit=$perpage;

    //     if($request->json('category')){
    //         $res=DB::table('galleries')->where(array('category'=>$request->json('category'),'status'=>1))->get();
    //     }else{
    //         $res=DB::table('galleries')->where(array('status'=>1))->get();
    //     }

    //     foreach($res as $row){
    //         $files=DB::table('gallery_files')->where('gallery_id',$row->id)->offset($offset)->limit($limit)->get();
    //         $row->files=$files;
    //         $row->image_url = URL::to('/storage/');
    //     }
    //     if(count($res) > 0){
    //         $result = array(
    //             'success' => true,
    //             'result' => $res
    //         );
    //         echo json_encode($result);
    //     }else{
    //         $result = array(
    //             'success' => false,
    //             'result' => 'Emptey table'
    //         );
    //         echo json_encode($result);
    //     }
    // }


}
