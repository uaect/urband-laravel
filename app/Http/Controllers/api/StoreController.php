<?php

namespace App\Http\Controllers\api;

use App\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Products;
use App\ProductsCategory;
use App\ProductsImages;
use App\Orders;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use App\ContentManagement;
use App\EventTickets;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class StoreController extends Controller
{
        public function index(Request $request)
    {
        $page = $request->json('page');
        $pricefrom = $request->json('pricefrom');
        $priceto = $request->json('priceto');
        $category = $request->json('category');
        $sort = $request->json('sort');

        $perpage=15;
        if(!$page) $page=1;
        $offset=$perpage*($page-1);
        $limit=$perpage;
        $query = DB::table('products')->where(array('status'=>1));
        if($category){
            $query->whereIn('category',$category);
        }
        if($pricefrom){
            $query->where('price','>=',$pricefrom);
        }
        if($priceto){
            $query->where('price','<=',$priceto);
        }
        if($sort){
            if($sort == 'new'){
                $query->orderBy('id','DESC');
            }else{
                $query->orderBy('id','ASC');
            }
        }
        $query->offset($offset)->limit($limit);
        $res = $query->latest()->get();
        foreach($res as $row){
            $files= DB::table('products_images')->where(array('products_id'=>$row->id))->get();
            $row->files=$files;
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

        public function details(Request $request)
    {
        $productid = $request->json('productid');
        $res = $query = DB::table('products')->where(array('id'=>$productid))->first();
        if($res->id){
            $files = DB::table('products_images')->where(array('products_id'=>$res->id))->get();
            if(count($files) > 0){
                $res->files=$files;
            }
        }
        if($res->id){
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

        public function category(Request $request)
    {
        $category = DB::table('products_categories')->get();
        if($category){
            $result = array(
                'success' => true,
                'result' => $category
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

        public function addcart(Request $request)
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
        $data['product_id'] = $request->json('productid');
        $data['user_id'] = $userid->user_id;
        $data['quantity'] = $request->json('quantity');
        $exist = $query = DB::table('cart')->where(array('user_id'=>$request->json('userid'),'product_id'=>$request->json('productid')))->first();
        if($exist){
            $quanity = $exist->quantity + $data['quantity'];
            $res = DB::table('cart')->where(array('user_id'=>$request->json('userid'),'product_id'=>$request->json('productid')))->update(array('quantity' => $quanity));
        }else{
            $res = DB::table('cart')->insert(
                $data
            );
        }
        if($res){
            $result = array(
                'success' => true,
                'message' => 'added to cart'
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

        public function getcart(Request $request)
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
        $item = DB::table('cart')->where(array('user_id'=>$userid->user_id))->latest()->get();
        foreach($item as $row){
            $product = DB::table('products')->where(array('id'=>$row->product_id))->first();
            $files= DB::table('products_images')->where(array('products_id'=>$row->product_id))->get();
            $row->product=$product;
            $row->files=$files;
        }
        if(count($item) > 0){
            $result = array(
                'success' => true,
                'result' => $item
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
                'result' => 'emtey cart'
            );
            return response($result)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Headers' => 'Origin, X-Requested-With, Content-Type, Accept',
            ]);
        }
    }

        public function removecart(Request $request)
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
        $productid = $request->json('productid');
        $delete = DB::table('cart')->where(array('product_id'=>$productid,'user_id'=>$userid->user_id))->delete();
        if($delete){
            $item = DB::table('cart')
            ->leftJoin('products', 'products.id', '=', 'cart.product_id')
            ->where(array('cart.user_id'=>$token))
            ->get();
            foreach($item as $row){
                $files= DB::table('products_images')->where(array('products_id'=>$row->product_id))->get();
                $row->files=$files;
            }
            if(count($item) > 0){
                $result = array(
                    'success' => true,
                    'result' => $item
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
                    'result' => 'emtey cart'
                );
                return response($result)
                ->withHeaders([
                    'Content-Type' => 'application/json',
                    'Access-Control-Allow-Origin' => '*',
                    'Access-Control-Allow-Headers' => 'Origin, X-Requested-With, Content-Type, Accept',
                ]);
            }
        }else{
            $result = array(
                'success' => false,
                'message' => 'cart not exist'
            );
            return response($result)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Headers' => 'Origin, X-Requested-With, Content-Type, Accept',
            ]);
        }
    }

        public function address(Request $request)
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
        $address= DB::table('addresses')->where(array('user_id'=>$userid->user_id))->get();
        if(count($address) > 0){
            $result = array(
                'success' => true,
                'result' => $address
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
                'result' => 'no address added'
            );
            return response($result)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Headers' => 'Origin, X-Requested-With, Content-Type, Accept',
            ]);
        }
    }


        public function addaddress(Request $request)
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
        $data['user_id'] = $userid->user_id;
        $data['type'] = $request->json('type')?$request->json('type'):"";
        $data['first_name'] = $request->json('first_name');
        $data['last_name'] = $request->json('last_name')?$request->json('last_name'):"";
        $data['mobile'] = $request->json('mobile');
        $data['phone'] = $request->json('phone')?$request->json('phone'):"";
        $data['emirate'] = $request->json('emirate')?$request->json('emirate'):"";
        $data['area'] = $request->json('area')?$request->json('area'):"";
        $data['street'] = $request->json('street')?$request->json('street'):"";
        $data['building'] = $request->json('building')?$request->json('building'):"";
        $data['roomno'] = $request->json('roomno')?$request->json('roomno'):"";
        $data['latitude'] = $request->json('latitude')?$request->json('latitude'):"";
        $data['longitude'] = $request->json('longitude')?$request->json('longitude'):"";
        $data['created_at'] = date("Y-m-d H:i:s");
        $data['updated_at'] = date("Y-m-d H:i:s");
        if($request->json('token')){
            DB::table('addresses')->where(array('user_id'=>$request->json('token')))->update(array('is_default' => 0));
        }
        $address = DB::table('addresses')->insert(
            $data
        );
        if($address){
            $result = array(
                'success' => true,
                'message' => 'new address added'
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

        public function removeaddress(Request $request)
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
        $addressid = $request->json('addressid');
        $address = DB::table('addresses')->where(array('id'=>$addressid,'user_id'=>$userid->user_id))->delete();
        if($address){
            $result = array(
                'success' => true,
                'message' => 'successfully removed'
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
                'message' => 'doesnot exist'
            );
            return response($result)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Headers' => 'Origin, X-Requested-With, Content-Type, Accept',
            ]);
        }
    }

        public function eventbooking(Request $request)
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
        $data['user_id'] = $userid->user_id;
        $data['event_id'] = $request->json('eventid')?$request->json('eventid'):"";
        $data['package_id'] = $request->json('packageid')?$request->json('packageid'):"";
        $data['quantity'] = $request->json('quantity')?$request->json('quantity'):"";
        $data['created_at'] = date("Y-m-d H:i:s");
        $data['updated_at'] = date("Y-m-d H:i:s");
        $data['booking_id'] = time() . mt_rand() . $data['user_id'];
        $data['qrcode'] = "";
        $data['barcode'] = "";
        $data['total'] = $request->json('total');
        $data['payment_option'] = $request->json('payment_option');
        $data['price'] = $request->json('price');
        $address = DB::table('event_tickets')->insertGetId(
            $data
        );
        if($address){
            $result = array(
                'success' => true,
                'message' => 'new event ticket booked'
            );
            $address = EventTickets::where('id',$address)->with('event')->first();
            $user = User::where('id',$userid->user_id)->with('address')->first();
            $company = ContentManagement::where('page','Contact Us')->first();
            $qr = QrCode::format('png')->size(200)->generate($address->booking_id);
            Mail::send('emails.tickets', ['address' => $address, 'user'=>$user, 'qr'=>$qr], function ($m) use ($address,$user,$company) {
                $m->from($company->email, 'Urband Music');
                $m->to($user->email, $user->name)->subject('Your Ticket To - '.$address->event->title.' | Urband Music');
            });
            Mail::send('emails.ticketbooked', ['address' => $address, 'user'=>$user, 'qr'=>$qr], function ($m) use ($company) {
                $m->from($company->email, 'Urband Music');
                $m->to($company->description, 'Urband Music')->subject('Event Ticket Booked! | Urband Music');
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
        public function proceedorder(Request $request)
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
        //print_r($userid);die;
        $data['user_id'] = $userid->user_id;
        $data['shipping_address_id'] = $request->json('address_id');
        $data['payment_option'] = $request->json('payment_option');
        $data['tracking_id'] = time() . mt_rand() . $data['user_id'];
        $data['grand_total'] = $request->json('grand_total');
        $data['vat'] = $request->json('vat');
        $data['delivery_charge'] = $request->json('delivery_charge');
        $data['created_at'] = date("Y-m-d H:i:s");
        $data['updated_at'] = date("Y-m-d H:i:s");
        $order = Orders::create($data);
        if($order){
            $status['order_id'] = $order->id;
            $status['status'] = "Ordered";
            $status['note'] = $request->json('note');
            $status['active'] = "1";
            $status['current'] = "1";
            $status['created_at'] = date("Y-m-d H:i:s");
            $status['updated_at'] = date("Y-m-d H:i:s");
            $status = DB::table('order_shipping_updates')->insert(
                $status
            );
            if($request->json('order_items')){
                $items = $request->json('order_items');
                if(count($items) > 0){
                    foreach($items as $row){
                        $item['product_id'] = $row['product_id'];
                        $item['order_id'] = $order->id;
                        $item['quantity'] = $row['quantity'];
                        $item['price'] = $row['product']['price'];
                        $item['created_at'] = date("Y-m-d H:i:s");
                        $item['updated_at'] = date("Y-m-d H:i:s");
                        DB::table('order_items')->insert(
                            $item
                        );
                        Cart::where(array('product_id'=>$row['product_id'],'user_id'=>$userid->user_id))->delete();
                        //DB::table('cart')->where(array('product_id'=>$row['product_id'],'user_id'=>$userid->user_id))->delete();
                    }
                }
            }
            $summary = DB::table('orders')->where(array('id'=>$order->id))->get();
            foreach($summary as $val){
                $val->items = DB::table('order_items')
                ->leftJoin('products', 'products.id', '=', 'order_items.product_id')
                ->leftJoin('products_images', 'products_images.id', '=', 'products.id')
                ->where(array('order_items.order_id'=>$order->id))
                ->get();
            }
            $result = array(
                'success' => true,
                'result' => $summary,
                'message' => 'new order added'
            );
            $company = ContentManagement::where('page','Contact Us')->first();
            $user = User::where('id',$userid->user_id)->with('address')->first();
            $address = $user->address->first();
            Mail::send('emails.orders', ['summary' => $summary,'user'=>$user, 'address'=>$address], function ($m) use ($summary,$user,$company) {
                $m->from($company->email, 'Urband Music');
                $m->to($user->email, $user->name)->subject('Thank you for your order!...Urband Music.');
            });
            Mail::send('emails.ordered', ['summary' => $summary,'user'=>$user, 'address'=>$address], function ($m) use ($summary,$user,$company) {
                $m->from($company->email, 'Urband Music');
                $m->to($company->description, 'Urband Music')->subject('Product Ordered!...Urband Music.');
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

        public function countries(Request $request)
    {
        $page = $request->json('page');
        $perpage=9;
        if(!$page) $page=1;
        $offset=$perpage*($page-1);
        $limit=$perpage;
        $query = DB::table('countries');
        if($request->json('id')){
            $query->where('parent_id',$request->json('id'));
        }else{
            $query->where('parent_id',1);
        }
        $res = $query->orderBy('location','ASC')->get();
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

        public function emiratescharge(Request $request)
    {
        $id = $request->json('emirateid');
        $emirateDetails = DB::table('shipping_charges')->where(array('id'=>$id))->get();
        if(count($emirateDetails) > 0){
            $result = array(
                'success' => true,
                'result' => $emirateDetails
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
                'result' => 'no emiartes details found'
            );
            return response($result)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Headers' => 'Origin, X-Requested-With, Content-Type, Accept',
            ]);
        }
    }

        public function updatequantity(Request $request)
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
        $res = DB::table('cart')->where(array('id'=>$request->json('cartid'),'user_id'=>$userid->user_id))->update(array('quantity' => $request->json('quantity')));
        if($res){
            $result = array(
                'success' => true,
                'message' => 'updated quantity'
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
                'message' => 'error. unknown cart'
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
