<?php
namespace App\Http\Controllers\API;

use App\ContentManagement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use File;
//use Mail;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewUserWelcomeMail;
use App\Visitors;

class UserController extends Controller
{
public $successStatus = 200;
/**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request){
        if($request->json('type') == "gmail" || $request->json('type') == "facebook"){
            $data['name'] = $request->json('firstname').' '.$request->json('lastname');
            $data['email'] = $request->json('email');
            $data['created_at'] = date("Y-m-d H:i:s");
            $data['updated_at'] = date("Y-m-d H:i:s");
            $data['role'] = "website";
            $data['through'] = $request->json('type');
            $user =  DB::table('users')->where(array('email'=>$request->json('email')))->first();
            if(@$user->email){
                $update['through'] = $request->json('type');
                DB::table('users')->where(array('email'=>$user->email))->update($update);
                $userid = DB::table('oauth_access_tokens')->where(array('user_id'=>$user->id))->first();
                $token_id = $userid->id;
            }else{
                $user = User::create($data);
                $tokenobj = $user->createToken('urband');
                $token = $tokenobj->accessToken;
                $token_id = $tokenobj->token->id;
            }
            $result = array(
                'success' => true,
                'token' => $token_id,
                'user' => $user
            );
            return response($result)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Headers' => 'Origin, X-Requested-With, Content-Type, Accept',
            ]);
        }else{
            if(Auth::attempt(['email' => $request->json('email'), 'password' => $request->json('password')])){
                $user = Auth::user();
                $tokenobj = $user->createToken('urband');
                //$tokenobj = \Auth::user()->createToken('name');
                $token = $tokenobj->accessToken;
                $token_id = $tokenobj->token->id;
                $result = array(
                    'success' => true,
                    'token' => $token_id,
                    'user' => $user
                );
                return response($result)
                ->withHeaders([
                    'Content-Type' => 'application/json',
                    'Access-Control-Allow-Origin' => '*',
                    'Access-Control-Allow-Headers' => 'Origin, X-Requested-With, Content-Type, Accept',
                ]);
            }
            else{
                return response()->json(['error'=>'Unauthorised'], 401);
            }

        }

    }
/**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
        public function register(Request $request)
    {
        $data['name'] = $request->json('name').' '.$request->json('lastname');
        $data['email'] = $request->json('email');
        $data['password'] = bcrypt($request->json('password'));
        $data['mobile'] = $request->json('mobile');
        $data['city'] = $request->json('city');
        $data['created_at'] = date("Y-m-d H:i:s");
        $data['updated_at'] = date("Y-m-d H:i:s");
        $data['role'] = "website";
        $data['through'] = "manual";
        $exist =  DB::table('users')->where(array('email'=>$request->json('email')))->first();
        if($exist){
            $result = array(
                'success' => false,
                'message' => 'user already exists'
            );
            return response($result)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Headers' => 'Origin, X-Requested-With, Content-Type, Accept',
            ]);
        }
        $user = User::create($data);
        $result = array(
            'success' => true,
            'token' => $user->createToken('urband')-> accessToken
        );
        $company = ContentManagement::where('page','Contact Us')->first();
        Mail::send('emails.register', ['user' => $user], function ($m) use ($user,$company) {
                $m->from($company->email, 'Urband Music');
                $m->to($user->email, $user->name)->subject('Welcome to Urband Music.');
            });
        // $name = $user->name;
        // Mail::to($user->email, $user->name)->send(new NewUserWelcomeMail($name));
        return response($result)
        ->withHeaders([
            'Content-Type' => 'application/json',
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Headers' => 'Origin, X-Requested-With, Content-Type, Accept',
        ]);
    }

        public function getuser(Request $request)
    {
        $token = $request->json('token');
        $userid = DB::table('oauth_access_tokens')->where(array('id'=>$token))->first();
        if(!@$userid->user_id){
            $result = array(
                'success' => false,
                'message' => 'token expired'
            );
            return response($result)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Headers' => 'Origin, X-Requested-With, Content-Type, Accept',
            ]);
        }
        $user = DB::table('users')->where(array('id'=>$userid->user_id))->first();
        if(@$user->id){
                $result = array(
                    'success' => true,
                    'result' => $user
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
                'message' => 'user not exist'
            );
            return response($result)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Headers' => 'Origin, X-Requested-With, Content-Type, Accept',
            ]);
        }
    }

        public function edituser(Request $request)
    {
        $token = $request->json('token');
        $userid = DB::table('oauth_access_tokens')->where(array('id'=>$token))->first();
        if(!$userid->user_id){
            $result = array(
                'success' => false,
                'message' => 'token expired'
            );
            return response($result)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Headers' => 'Origin, X-Requested-With, Content-Type, Accept',
            ]);
        }
        if($request->json('name')){
            $data['name'] = $request->json('name');
        }
        if($request->json('email')){
            $data['email'] = $request->json('email');
        }
        // $imagePath = $request->file('image')->store('uploads','public');
        // $image = Image::make(public_path("storage/{$imagePath}"));
        // $image->save();
        // $data['image'] = $imagePath;
        $data['updated_at'] = date("Y-m-d H:i:s");
        $update = DB::table('users')->where(array('id'=>$userid->user_id))->update($data);
        if($update){
            $result = array(
                'success' => true,
                'message' => 'Sucessfully updated'
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

        public function getorder(Request $request)
    {
        $token = $request->json('token');
        $userid = DB::table('oauth_access_tokens')->where(array('id'=>$token))->first();
        if(!@$userid->user_id){
            $result = array(
                'success' => false,
                'message' => 'token expired'
            );
            return response($result)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Headers' => 'Origin, X-Requested-With, Content-Type, Accept',
            ]);
        }

        $order = DB::table('orders')->where(array('user_id'=>$userid->user_id))->orderBy('id', 'desc')->get();
        foreach($order as $row){
            $row->order_status =  DB::table('order_shipping_updates')->where(array('order_id'=>$row->id,'current'=>1))->first();
            $row->order_items = DB::table('order_items')
            ->leftJoin('products', 'products.id', '=', 'order_items.product_id')
            ->where(array('order_items.order_id'=>$row->id))
            ->get();
            foreach($row->order_items as $item){
                $item->files= DB::table('products_images')->where(array('products_id'=>$item->id))->get();
            }
        }

        if(count($order) > 0){
            $result = array(
                'success' => true,
                'result' => $order,
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
                'result' => 'no order'
            );
            return response($result)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Headers' => 'Origin, X-Requested-With, Content-Type, Accept',
            ]);
        }
    }

        public function visitors(Request $request)
    {
        $visitor = Visitors::where('ip',$request->json('ip'))->first();
        $visitors = '';
        if(!$visitor){
        $data['ip'] = $request->json('ip');
        $data['hits'] = "1";
        $data['created_at'] = date("Y-m-d H:i:s");
        $data['updated_at'] = date("Y-m-d H:i:s");
        $visitors = DB::table('visitors')->insert(
            $data
        );
        }
        if($visitors){
            $result = array(
                'success' => true,
                'message' => 'record inserted'
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
