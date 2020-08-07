<?php

namespace App\Http\Controllers;

use App\ContentManagement;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Alert;
use App\Traits\UploadTraits;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Input;
class AboutController extends Controller
{
    use UploadTraits;
    public function __construct()
    {
        // $auth = auth()->user();
        // if($auth->role!='admin'){
        //     return redirect()->route('home');
        // }
    }
    public function index()
    {
        return view('dashboard');
    }
    public function who_we_are(ContentManagement $model)
    {
        return view('about.who-we-are', ['about' => $model->where('page','Who We Are')->first()]);
    }
    public function what_we_do(ContentManagement $model)
    {
        return view('about.what-we-do', ['abouts' => $model->where(array('page'=>'What We Do','status'=>1))->paginate(15)]);
    }
    public function add_what_we_do()
    {
        return view('about.add-what-we-do');
    }
    public function edit_what_we_do(ContentManagement $about)
    {
        return view('about.edit-what-we-do', compact('about'));
    }
    public function show_what_we_do(ContentManagement $about)
    {
        return view('about.show-what-we-do',  compact('about'));
    }
    public function gang(ContentManagement $model)
    {
        return view('about.gang', ['abouts' => $model->where(array('page'=>'Gang','status'=>1))->paginate(15)]);
    }
    public function add_gang()
    {
        return view('about.add-gang');
    }
    public function show_gang(ContentManagement $about)
    {
        return view('about.add-gang', compact('about'));
    }
    public function edit_gang(ContentManagement $about)
    {
        return view('about.edit-gang', compact('about'));
    }
    public function settings(ContentManagement $model)
    {
        //dd($model->where('page','Details')->latest()->get());
        return view('about.settings',['about' => $model->where('page','Contact Us')->first(),'social' => $model->where('page','Social')->latest()->get(),'details' => $model->where('page','Details')->latest()->get()]);
    }
    public function pages(ContentManagement $model)
    {
        return view('about.pages',['pages' => $model->where('page','Pages')->paginate(15)]);
    }
    public function insert_page(Request $request, ContentManagement $model)
    {
        $result = $model->where(array('page'=>'Pages','title'=>'Pages'))->first();
        $data = request()->validate([
            'title' =>'required',
            'description' => '',
        ]);
        try{
        if($result){
            $result->update($data);
        }
        } catch (\Exception $ex){
            return back()->withError($ex->getMessage());
        }catch (\Error $ex){
            return back()->withError($ex->getMessage());
        }
        return redirect()->route('about.who-we-are')->withStatus(__('Pages successfully updated.'));
    }
    public function insert_about(Request $request, ContentManagement $model)
    {
        $result = $model->where('page','Who We Are')->first();
        $data = request()->validate([
            'title' =>'required',
            'description' => '',
        ]);
        try{
        if($result){
        $page = ['page'=>'Who We Are','description'=>$request->input('description')];
        $data = array_merge($data,$page??[]);
        if(request('image')){
            $imagePath = request('image')->store('uploads','public');
            $image = Image::make(public_path("storage/{$imagePath}"));
            $image->save();
            $imageArray = ['image'=>$imagePath ];
        }
        $result->update(array_merge($data,$imageArray??[]));
    }else{
        $page = ['page'=>'Who We Are','description'=>$request->input('description')];
        $data = array_merge($data,$page??[]);
        if(request('image')){
            $imagePath = request('image')->store('uploads','public');
            $image = Image::make(public_path("storage/{$imagePath}"));
            $image->save();
            $imageArray = ['image'=>$imagePath ];
        }
        auth()->user()->content()->create(array_merge($data,$imageArray??[]));
    }
} catch (\Exception $ex){
    return back()->withError($ex->getMessage());
}catch (\Error $ex){
    return back()->withError($ex->getMessage());
}
        return redirect()->route('about.who-we-are')->withStatus(__('Who we are successfully created.'));
    }
    public function insert_settings(Request $request, ContentManagement $model)
    {
        $result = $model->where('page','Contact Us')->first();
        $data = request()->validate([
            'email' => 'email',
            'phone' => '',
            'location' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);
        try{
        if($result){
        $page = ['page'=>'Contact Us','description'=>$request->input('order_email')];
        $data = array_merge($data,$page??[]);
        if(request('image')){
            $imagePath = request('image')->store('uploads','public');
            $image = Image::make(public_path("storage/{$imagePath}"));
            $image->save();
            $imageArray = ['image'=>$imagePath ];
        }
        $details = $model->where('page','Details')->delete();
        $userid = Auth::user()->id;
        $data_details = array(
            array('page'=>'Details', 'title'=>'Founded', 'description'=>$request->founded,'user_id'=>$userid),
            array('page'=>'Details', 'title'=>'Doing', 'description'=>$request->doing,'user_id'=>$userid),
            array('page'=>'Details', 'title'=>'Clients', 'description'=>$request->clients,'user_id'=>$userid),
            array('page'=>'Details', 'title'=>'Events', 'description'=>$request->events,'user_id'=>$userid),
        );
        ContentManagement::insert($data_details);
        $delete = $model->where('page','Social')->delete();
        foreach ($request->social as $key => $value) {
            $social = [
                'page'=>'Social',
                'title'=>$value['title'],
                'description'=>$value['url']
            ];
            auth()->user()->content()->create($social);
        }
        $result->update(array_merge($data,$imageArray??[]));
    }else{
        $page = ['page'=>'Contact Us'];
        $data = array_merge($data,$page??[]);
        if(request('image')){
            $imagePath = request('image')->store('uploads','public');
            $image = Image::make(public_path("storage/{$imagePath}"));
            $image->save();
            $imageArray = ['image'=>$imagePath ];
        }
        auth()->user()->content()->create(array_merge($data,$imageArray??[]));
    }
    } catch (\Exception $ex){
        return back()->withError($ex->getMessage());
    }catch (\Error $ex){
        return back()->withError($ex->getMessage());
    }
        Alert::message('Settings updated successfully!');
        return redirect()->route('contact.settings')->with('success', __('Settings successfully created.'));
    }
    public function insert_what_we_do(Request $request, ContentManagement $model)
    {
        $data = request()->validate([
            'title' =>'required',
            'description' => '',
        ]);
        try{
        $page = ['page'=>'What We Do','description'=>$request->input('description')];

        $data = array_merge($data,$page??[]);
        if(request('image')){
            $imagePath = request('image')->store('uploads','public');
            $image = Image::make(public_path("storage/{$imagePath}"));
            $image->save();
            $imageArray = ['image'=>$imagePath ];
        }
        auth()->user()->content()->create(array_merge($data,$imageArray??[]));
        } catch (\Exception $ex){
            return back()->withError($ex->getMessage());
        }catch (\Error $ex){
            return back()->withError($ex->getMessage());
        }
        return redirect()->route('about.what-we-do')->withStatus(__('What we do successfully created.'));
    }
    public function destroy(Request $request)
    {
        try{
        $data = ['status'=>0];
        ContentManagement::where('id',$request->item_id)->update($data);
        } catch (\Exception $ex){
            return back()->withError($ex->getMessage());
        }catch (\Error $ex){
            return back()->withError($ex->getMessage());
        }
        return 'Who we are successfully deleted.';
    }
    public function insert_gang(Request $request, ContentManagement $model)
    {
        $data = request()->validate([
            'title' =>'required',
            'image' =>'required|image|mimes:jpeg,png,jpg|max:10248',
        ]);
        try{
        $page = ['page'=>'Gang'];
        $data = array_merge($data,$page??[]);
        if(request('image')){
            $imagePath = request('image')->store('uploads','public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(375,467);
            $image->save();
            $imageArray = ['image'=>$imagePath ];
        }
        auth()->user()->content()->create(array_merge($data,$imageArray??[]));
        } catch (\Exception $ex){
            return back()->withError($ex->getMessage());
        }catch (\Error $ex){
            return back()->withError($ex->getMessage());
        }
        return redirect()->route('about.gang')->withStatus(__('Gang successfully created.'));
    }
    public function change_status(Request $request)
    {
        try{
        $result = ContentManagement::where('id',$request->item_id)->first();
        if($request->title_value){
            $data = ['title'=>$request->title_value];
        }elseif($result->status==1){
            $data = ['status'=>0];
        }else{
            $data = ['status'=>1];
        }
        ContentManagement::where('id',$request->item_id)->update($data);
        } catch (\Exception $ex){
            return back()->withError($ex->getMessage());
        }catch (\Error $ex){
            return back()->withError($ex->getMessage());
        }
        return 'Updated successfully.';
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
