<?php
namespace App\Http\Controllers\api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Banner;
use Illuminate\Support\Facades\URL;

class BannerController extends Controller
{
        public function index(Request $request)
    {
        $page = $request->json('page');
        $res= DB::table('banners')->where('status',1)->where('page', 'LIKE', '%' . $page . '%')->latest()->get();
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
