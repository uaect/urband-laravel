<?php
namespace App\Http\Controllers\api;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContentManagement as ContentResource;
use App\ContentManagement;
use App\PreviousShows;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;

class AboutController extends Controller
{
    public function __construct()
    {
        // header('Content-Type: application/json');
        // header('Access-Control-Allow-Origin: *');
        // header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
        // header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    }
    //     public function index()
    // {
    //     $res=DB::table('content_management')->where(array('page'=>'Contact Us','status'=>1))->first();
    //     if($res){
    //         $result = array(
    //             'success' => true,
    //             'result' => $res,
    //             'image_url' => URL::to('/storage/')
    //         );
    //         echo json_encode($result);
    //     }else{
    //         $result = array(
    //             'success' => false,
    //             'result' => 'no result'
    //         );
    //         echo json_encode($result);
    //     }
    //     //return ContentResource::collection(ContentManagement::where('page','Contact Us')->first());
    // }
        public function aboutus()
    {
        $res['contactus']=ContentManagement::where(array('page'=>'Contact Us','status'=>1))->first();//DB::table('content_management')->where(array('page'=>'Contact Us','status'=>1))->first();
        $res['whoweare']=ContentManagement::where(array('page'=>'Who We Are','status'=>1))->first();//DB::table('content_management')->where(array('page'=>'Who We Are','status'=>1))->first();
        $res['whatwedo']=ContentManagement::where(array('page'=>'What We Do','status'=>1))->latest()->limit(10)->get();//DB::table('content_management')->where(array('page'=>'What We Do','status'=>1))->latest()->limit(10)->get();
        $res['gang']=ContentManagement::where(array('page'=>'Gang','status'=>1))->latest()->limit(10)->get();//DB::table('content_management')->where(array('page'=>'Gang','status'=>1))->latest()->limit(10)->get();
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

        public function previousshow(Request $request)
    {
        $res=PreviousShows::where(array('type'=>'Previous Shows'))->first();//DB::table('previous_shows')->where(array('type'=>'Previous Shows'))->latest()->first();
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

        public function spotlight(Request $request)
    {
        $res=PreviousShows::where(array('type'=>'spotlight'))->first();//DB::table('previous_shows')->where(array('type'=>'spotlight'))->latest()->first();
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

        public function menues(Request $request)
    {
        $res=DB::table('content_management')->where(array('page'=>'pages','status'=>1))->orderBy('order')->get(); //ContentManagement::where(array('page'=>'pages','status'=>1))->get();
        if($res){
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

        public function social(Request $request)
    {
        $res=ContentManagement::select('title','description')->where(array('page'=>'social','status'=>1))->get();//DB::table('content_management')->select('title','description')->where(array('page'=>'social','status'=>1))->get();
        if($res){
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

        public function subscribe(Request $request)
    {
        $data['email'] = $request->json('email')?$request->json('email'):"";
        $data['status'] = "1";
        $data['created_at'] = date("Y-m-d H:i:s");
        $data['updated_at'] = date("Y-m-d H:i:s");
        $existEmail= DB::table('newsletter')->where(array('email'=>$data['email']))->get();
        if(count($existEmail) > 0){
            $result = array(
                'success' => false,
                'message' => 'Already Subscribed'
            );
            return response($result)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Headers' => 'Origin, X-Requested-With, Content-Type, Accept',
            ]);
        }else{
            $res = DB::table('newsletter')->insert(
                $data
            );
            if($res){
                $result = array(
                    'success' => true,
                    'message' => 'subscribed'
                );
                $email = $data['email'];
                $company = ContentManagement::where('page','Contact Us')->first();
                Mail::send('emails.subscribe', ['email' => $email], function ($m) use ($email,$company) {
                    $m->from($company->email, 'Urband Music');
                    $m->to($email, 'Urband Music')->subject('Subscribed!...Urband Music.');
                });
                return response($result)
                ->withHeaders([
                    'Content-Type' => 'application/json',
                    'Access-Control-Allow-Origin' => '*',
                    'Access-Control-Allow-Headers' => 'Origin, X-Requested-With, Content-Type, Accept',
                ]);
            }else{
                $result = array(
                    'success' => false,
                    'message' => 'error'
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
    public function founded(Request $request)
    {
        $res=ContentManagement::select('title','description')->where(array('page'=>'Details','status'=>1))->get();//DB::table('content_management')->select('title','description')->where(array('page'=>'Details','status'=>1))->latest()->get();
        if($res){
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
    public function contact_us(Request $request)
    {
        $name = $request->json('name')?$request->json('name'):"";
        $email = $request->json('email')?$request->json('email'):"";
        $contact_message = $request->json('message')?$request->json('message'):"";
        if($email && $name && $contact_message){
            $result = array(
                'success' => true,
                'message' => 'mail send'
            );
            $company = ContentManagement::where('page','Contact Us')->first();
            Mail::send('emails.contact_us', ['name' => $name,'email' => $email,'contact_message' => $contact_message], function ($m) use ($company,$name) {
                $m->from($company->email, 'Urband Music');
                $m->to($company->email, 'Urband Music Enquiry')->subject('Enquiry from '.$name.'!...Urband Music.');
            });
            return response($result)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Headers' => 'Origin, X-Requested-With, Content-Type, Accept',
            ]);
        }else{
            $result = array(
                'success' => false,
                'message' => 'error'
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
