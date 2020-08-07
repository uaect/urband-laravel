<?php
namespace App\Http\Controllers\api;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ContentManagement;
use App\Http\Resources\ContentManagement as ContentResources;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\URL;

class ClientController extends Controller
{
        public function index(Request $request)
    {
        $page = $request->json('page');
        $perpage=9;
        if(!$page) $page=1;
        $offset=$perpage*($page-1);
        $limit=$perpage;
        $res=DB::table('content_management')->where(array('page'=>'Clients','status'=>1))->offset($offset)->limit($limit)->latest()->get();
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

        public function feedback(Request $request)
    {
        $page = $request->json('page');
        $perpage=9;
        if(!$page) $page=1;
        $offset=$perpage*($page-1);
        $limit=$perpage;
        $res=DB::table('content_management')->where(array('page'=>'Clients Feedback','status'=>1))->offset($offset)->limit($limit)->latest()->get();
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

}
