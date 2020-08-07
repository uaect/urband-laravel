<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use App\Traits\UploadTraits;

class BannerController extends Controller
{
    use UploadTraits;
    public function index(Banner $model)
    {
        return view('banners.index', ['banners' => $model->where(array('status'=>1))->latest()->paginate(15)]);
    }
    public function show(Banner $banner)
    {
        return view('banners.show', compact('banner'));
    }
    public function create()
    {
        return view('banners.create');
    }
    public function store(Request $request, Banner $model)
    {
        $data = request()->validate([
            'title' =>'required',
            'sub_title' => '',
            'page' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png,gif|max:10000',
        ]);
        try{
        $page = ['page'=> json_encode($request->input('page'))];
        $data = array_merge($data,$page??[]);
        // if(request('image')){
        //     $filename = 'urband_banner_'.request('image');
        //     $imagePath = request('image')->store('uploads','public');
        //     $image = Image::make(public_path("storage/{$imagePath}"))->fit(1800,540);
        //     $image->save();
        //     $imageArray = ['image'=>$imagePath ];
        // }
        if ($request->has('image')) {
                $image = $request->file('image');
                if($image->getClientOriginalExtension()=='gif'){
                    $name = Str::slug($request->input('title')).'_'.time();
                    $folder = '/uploads/';
                    $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
                    $this->uploadOne($image, $folder, 'public', $name);
                    $imageArray = ['image'=>$filePath ];
                }else{
                    $imagePath = request('image')->store('uploads','public');
                    $image = Image::make(public_path("storage/{$imagePath}"))->fit(1800,540);
                    $image->save();
                    $imageArray = ['image'=>$imagePath ];
                }
        }
        auth()->user()->banner()->create(array_merge($data,$imageArray??[]));
        } catch (\Exception $ex){
            return back()->withError($ex->getMessage());
        }catch (\Error $ex){
            return back()->withError($ex->getMessage());
        }
        return redirect()->route('banner.index')->withStatus(__('Banner successfully created.'));
    }
    public function edit(Banner $banner)
    {
        return view('banners.edit', compact('banner'));
    }
    public function update(Request $request, Banner  $banner)
    {
        $data = request()->validate([
            'title' =>'required',
            'sub_title' => '',
            'page' => 'required',
        ]);
        try{
        $page = ['page'=>json_encode($request->input('page'))];
        $data = array_merge($data,$page??[]);
        // if(request('image')){
        //     $imagePath = request('image')->store('uploads','public');
        //     $image = Image::make(public_path("storage/{$imagePath}"))->fit(1400,840);
        //     $image->save();
        //     $imageArray = ['image'=> $imagePath ];
        // }
        if ($request->has('image')) {
            $image = $request->file('image');
            $name = Str::slug($request->input('title')).'_'.time();
            $folder = '/uploads/';
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            $this->uploadOne($image, $folder, 'public', $name);
            $imageArray = ['image'=>$filePath ];
        }
        $banner->update(array_merge($data,$imageArray??[]));
        } catch (\Exception $ex){
            return back()->withError($ex->getMessage());
        }catch (\Error $ex){
            return back()->withError($ex->getMessage());
        }
        return redirect()->route('banner.index')->withStatus(__('Banner successfully updated.'));
    }
    public function destroy(Request $request)
    {
        try{
        $data = ['status'=>0];
        Banner::where('id',$request->item_id)->update($data);
        } catch (\Exception $ex){
            return back()->withError($ex->getMessage());
        }catch (\Error $ex){
            return back()->withError($ex->getMessage());
        }
        return 'Banner successfully deleted.';
    }
}
