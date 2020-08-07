<?php

namespace App\Http\Controllers;

use App\ContentManagement;
use Illuminate\Http\Request;
use App\EventTickets as Tickets;

class EventTicketsController extends Controller
{
    public function index(Tickets $model)
    {
        return view('tickets.index', ['tickets' => $model->latest()->with('user','event','package')->paginate(15)]);
    }
    public function show($id)
    {
        try{
        $data = ['read' => 1];
        Tickets::where('id',$id)->update($data);
        $tickets = Tickets::findOrFail($id);
        $user = $tickets->user()->with('address')->first();
        $address = $user->address->first();
        $package = $tickets->package()->get();
        $company = ContentManagement::where('page','Contact Us')->first();
    } catch (\Exception $ex){
        return back()->withError($ex->getMessage());
    }catch (\Error $ex){
        return back()->withError($ex->getMessage());
    }
        return view('tickets.show', compact('tickets', 'user', 'package','address','company'));
    }
    public function edit(Tickets $tickets)
    {
        return view('tickets.edit', compact('tickets'));
    }
    public function update(Request $request, Tickets  $tickets)
    {
        $data = request()->validate([
            'title' =>'required',
        ]);
        try{
        $tickets->update($data);
    } catch (\Exception $ex){
        return back()->withError($ex->getMessage());
    }catch (\Error $ex){
        return back()->withError($ex->getMessage());
    }
        return redirect()->route('tickets.index')->withStatus(__('Product Category successfully updated.'));
    }
    public function destroy(Request $request)
    {
        try{
        Tickets::where('id',$request->item_id)->delete();
    } catch (\Exception $ex){
        return back()->withError($ex->getMessage());
    }catch (\Error $ex){
        return back()->withError($ex->getMessage());
    }
        return 'Product successfully deleted.';
    }
}
