<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vlog;

class VlogController extends Controller
{
    public function index(Vlog $model)
    {
        return view('vlogs.index', ['vlogs' => $model->active()->latest()->paginate(15)]);
    }
    public function show($vlogs)
    {
        $vlogs = Vlog::findOrFail($vlogs);
        return view('vlogs.show', compact('vlogs'));
    }
    public function create()
    {
        return view('vlogs.create');
    }
    public function store(Request $request, Vlog $model)
    {
        $data = request()->validate([
            'title' =>'required',
            'description' => '',
        ]);
        try{
        $vlogs = auth()->user()->vlog()->create(array_merge($data));
    } catch (\Exception $ex){
        return back()->withError($ex->getMessage());
    }catch (\Error $ex){
        return back()->withError($ex->getMessage());
    }
        return redirect()->route('vlogs.index')->withStatus(__('Vlog successfully created.'));
    }
    public function edit($vlogs)
    {
        $vlogs = Vlog::find($vlogs);
        return view('vlogs.edit', compact('vlogs'));
    }
    public function update(Request $request,$vlogs)
    {
        try{
        $vlogs = Vlog::find($vlogs);
        $data = request()->validate([
            'title' =>'required',
            'description' => '',
        ]);
        $vlogs->update($data);
    } catch (\Exception $ex){
        return back()->withError($ex->getMessage());
    }catch (\Error $ex){
        return back()->withError($ex->getMessage());
    }
        return redirect()->route('vlogs.index')->withStatus(__('Vlog successfully updated.'));
    }
    public function destroy(Request $request)
    {
        try{
        $data = ['status'=>0];
        Vlog::where('id',$request->item_id)->update($data);
    } catch (\Exception $ex){
        return back()->withError($ex->getMessage());
    }catch (\Error $ex){
        return back()->withError($ex->getMessage());
    }
        return 'Vlog successfully deleted.';
    }
}
