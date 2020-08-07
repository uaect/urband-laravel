<?php

namespace App\Http\Controllers;

use App\Countries;
use App\Shipping;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function index(Shipping $model)
    {
        return view('shipping.index', ['shipping' => $model->latest()->with('city')->paginate(15)]);
    }
    public function show(Shipping $shipping)
    {
        return view('shipping.show', compact('shipping'));
    }
    public function create()
    {
        $cities = Countries::where('parent_id',1)->get();
        return view('shipping.create', compact('cities'));
    }
    public function store(Request $request, Shipping $model)
    {
        // $old = Shipping::where('cities',$request->cities)->first();
        // if($old){
        //     return redirect()->route('shipping.create')->withStatus(__('Shipping successfully created.'));
        // }else{
            $data = request()->validate([
                'cities' =>'required|unique:shipping_charges,cities',
                'amount' =>'required',
                'estimate_time' =>'required',
            ]);
            try{
            $country = ['country'=>1];
            $data = array_merge($data,$country??[]);
            $shipping = auth()->user()->shipping()->create($data);
        } catch (\Exception $ex){
            return back()->withError($ex->getMessage());
        }catch (\Error $ex){
            return back()->withError($ex->getMessage());
        }
        //}
        return redirect()->route('shipping.index')->withStatus(__('Shipping successfully created.'));
    }
    public function edit(Shipping $shipping)
    {
        $cities = Countries::where('parent_id',1)->get();
        return view('shipping.edit', compact('shipping','cities'));
    }
    public function update(Request $request, Shipping  $shipping)
    {
        $data = request()->validate([
            'cities' =>'required',
            'amount' =>'required',
            'estimate_time' =>'required',
        ]);
        try{
        $shipping->update($data);
    } catch (\Exception $ex){
        return back()->withError($ex->getMessage());
    }catch (\Error $ex){
        return back()->withError($ex->getMessage());
    }
        return redirect()->route('shipping.index')->withStatus(__('Shipping successfully updated.'));
    }
    public function destroy(Request $request)
    {
        try{
        Shipping::where('id',$request->item_id)->delete();
    } catch (\Exception $ex){
        return back()->withError($ex->getMessage());
    }catch (\Error $ex){
        return back()->withError($ex->getMessage());
    }
        return 'Product successfully deleted.';
    }
}
