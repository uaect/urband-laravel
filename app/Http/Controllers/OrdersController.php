<?php

namespace App\Http\Controllers;

use App\ContentManagement;
use App\Orders;
use App\OrderShippingUpdates;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index(Orders $model)
    {
        return view('orders.index', ['orders' => $model->latest()->with('user','orderitems')->paginate(15)]);
    }
    public function show($id)
    {
        try{
        $data = ['read' => 1];
        Orders::where('id',$id)->update($data);
        $orders = Orders::with('orderitems','shippingupdates')->findOrFail($id);
        $items = $orders->orderitems()->with('product','productimage')->get();
        $user = $orders->user()->with('address')->first();
        $address = $user->address->first();
        $company = ContentManagement::where('page','Contact Us')->first();
    } catch (\Exception $ex){
        return back()->withError($ex->getMessage());
    }catch (\Error $ex){
        return back()->withError($ex->getMessage());
    }
        return view('orders.show', compact('orders', 'user', 'items','address','company'));
    }
    public function edit(Orders $orders)
    {
        return view('orders.edit', compact('orders'));
    }
    public function update(Request $request, Orders  $orders)
    {
        $data = request()->validate([
            'title' =>'required',
        ]);
        try{
        $orders->update($data);
    } catch (\Exception $ex){
        return back()->withError($ex->getMessage());
    }catch (\Error $ex){
        return back()->withError($ex->getMessage());
    }
        return redirect()->route('orders.index')->withStatus(__('Order successfully updated.'));
    }
    public function destroystatus(Request $request)
    {
        try{
        OrderShippingUpdates::where('id',$request->item_id)->delete();
    } catch (\Exception $ex){
        return back()->withError($ex->getMessage());
    }catch (\Error $ex){
        return back()->withError($ex->getMessage());
    }
        return 'Status successfully deleted.';
    }
    public function destroy(Request $request)
    {
        try{
        Orders::where('id',$request->item_id)->delete();
    } catch (\Exception $ex){
        return back()->withError($ex->getMessage());
    }catch (\Error $ex){
        return back()->withError($ex->getMessage());
    }
        return 'Product successfully deleted.';
    }
    public function updatestatus(Request $request, $id)
    {
        try{
        $data = request()->validate([
            'status' =>'required',
            'note' => 'sometimes',
        ]);
        $check = OrderShippingUpdates::where(array('order_id'=>$id,'status'=>$request->input('status')))->first();
        if($check){
            return redirect()->route('orders.show',$id)->withErrorStatus(__('Order already updated.'));
        }else{
            $updatecurrent = ['current'=>0];
            OrderShippingUpdates::where('order_id',$id)->update($updatecurrent);
            $order = ['order_id'=>$id,'current'=>1];
            $orders = OrderShippingUpdates::create(array_merge($data,$order??[]));
            // $updateorder = ['order_status_id' => $orders->id];
            // Orders::where('id',$id)->update($updateorder);
        }
    } catch (\Exception $ex){
        return back()->withError($ex->getMessage());
    }catch (\Error $ex){
        return back()->withError($ex->getMessage());
    }
        return redirect()->route('orders.show',$id)->withStatus(__('Order successfully updated.'));
    }
}
