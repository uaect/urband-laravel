<?php

namespace App\Http\Controllers;

use App\Event;
use App\Products;
use App\User;
use App\Visitors;
use App\Charts\LineChart;
use App\ContentManagement;
use App\EventTickets;
use App\Orders;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // $userid = 35;
        // $summary = Orders::where('id',1)->with('orderitems')->first();
        // //$qrcode = QrCode::size(300)->generate($address->booking_id);
        // //$userid->user_id;
        // //echo env('MAIL_DRIVER');exit;
        // $user = User::where('id',$userid)->with('address')->first();
        // $address = $user->address->first();
        //     Mail::send('emails.orders', ['summary' => $summary,'user'=>$user, 'address'=>$address], function ($m) use ($summary,$user) {
        //         $m->from('admin@urbandmusic.com', 'Urband Music');
        //         $m->to($user->email, $user->name)->subject('Thank you for your order!...Urband Music.');
        //     });


        $data = collect([]); // Could also be an array
        $first_date = Visitors::select('created_at')->orderBy('id','ASC')->first();
        $date = Carbon::now();
        $to_month = date("Y-m-d", strtotime("+1 months", strtotime($date)));
        $from_month = date("Y-m-d", strtotime("-10 months", strtotime($to_month)));
        $visitors = Visitors::select('created_at')->whereBetween('created_at', [$from_month, $to_month])->groupBy('created_at')->get();
        $values = array();
        $counts = array();
        foreach($visitors as $val){
            $values[] = date("F", strtotime($val->created_at));
            $counts[] = Visitors::whereMonth('created_at', '=', date("m", strtotime($val->created_at)))->groupBy('created_at')->sum('hits');
        }
        // $counts = Visitors::select('created_at')->whereBetween('created_at', [$from_month, $to_month])->groupBy('created_at')->get();
        // echo '<pre>';
        // print_r($values);
        // print_r($counts);
        // echo '</pre>';
        // exit;
        $chart = new LineChart;
        $chart->labels($values);
        $chart->dataset('My dataset', 'line', $counts);


        $visitors = Visitors::all();
        $users = User::where('role','website')->get();
        $products = Products::where('status',1)->get();
        $events = Event::where('status',1)->get();









        return view('dashboard',compact('visitors','users','products','events','chart'));
    }
    public function title_update(Request $request)
    {
        try{
        $result = ContentManagement::where('id',$request->item_id)->first();
        if($result){
        $data = ['title'=>$request->title_value];
        ContentManagement::where('id',$request->item_id)->update($data);
        }
        } catch (\Exception $ex){
            return back()->withError($ex->getMessage());
        }catch (\Error $ex){
            return back()->withError($ex->getMessage());
        }
        return 'Updated successfully.';
    }
}
