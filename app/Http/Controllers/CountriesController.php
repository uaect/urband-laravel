<?php

namespace App\Http\Controllers;

use App\Countries;
use Illuminate\Http\Request;

class CountriesController extends Controller
{
    public function index(Countries $model)
    {
        return view('cities.index', ['cities' => $model->where('parent_id','!=',0)->latest()->with('area')->paginate(15)]);
    }
    public function show(Countries $cities)
    {
        return view('cities.show', compact('cities'));
    }
    public function create()
    {
        $cities = Countries::where('parent_id',1)->get();
        return view('cities.create', compact('cities'));
    }
    public function store(Request $request, Countries $model)
    {
        // $old = Countries::where('cities',$request->cities)->first();
        // if($old){
        //     return redirect()->route('cities.create')->withStatus(__('Countries successfully created.'));
        // }else{
            $data = request()->validate([
                'cities' =>'required|unique:cities_charges,cities',
                'amount' =>'required',
                'estimate_time' =>'required',
            ]);
            try{
            $country = ['country'=>1];
            $data = array_merge($data,$country??[]);
            $cities = auth()->user()->cities()->create($data);
        } catch (\Exception $ex){
            return back()->withError($ex->getMessage());
        }catch (\Error $ex){
            return back()->withError($ex->getMessage());
        }
        //}
        return redirect()->route('cities.index')->withStatus(__('Countries successfully created.'));
    }
    public function edit(Countries $cities)
    {
        $cities = Countries::where('parent_id',1)->get();
        return view('cities.edit', compact('cities','cities'));
    }
    public function update(Request $request, Countries  $cities)
    {
        $data = request()->validate([
            'cities' =>'required',
            'amount' =>'required',
            'estimate_time' =>'required',
        ]);
        try{
        $cities->update($data);
    } catch (\Exception $ex){
        return back()->withError($ex->getMessage());
    }catch (\Error $ex){
        return back()->withError($ex->getMessage());
    }
        return redirect()->route('cities.index')->withStatus(__('Countries successfully updated.'));
    }
    public function destroy(Request $request)
    {
        try{
        Countries::where('id',$request->item_id)->delete();
    } catch (\Exception $ex){
        return back()->withError($ex->getMessage());
    }catch (\Error $ex){
        return back()->withError($ex->getMessage());
    }
        return 'Product successfully deleted.';
    }
}
