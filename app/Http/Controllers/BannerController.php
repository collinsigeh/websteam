<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::latest()->paginate(10);

        return view('banners.index', [
            'banners' => $banners,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $categories = Category::where('is_active', 1)->orderBy('category_name', 'asc')->get();
        if ($categories->count() < 1)
        {
            $request->session()->put('error_message', 'No post category found. Start by creating one here.');
            return to_route('categories.create');
        }
        $min_timestamp = Carbon::now()->timestamp + (15 * 60);
        $min_time = date('Y-m-d H:i',$min_timestamp);
        
        $min_stop_timestamp = $min_timestamp + (60 * 60 * 24);
        $min_stop_time = date('Y-m-d H:i',$min_stop_timestamp);

        return view('banners.create', [
            'categories' => $categories,
            'min_time' => $min_time,
            'min_stop_time' => $min_stop_time,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:200',
            'redirect_url' => 'required|max:250',
            'start_display_at' => 'required|date',
            'stop_display_at' => 'required|date|after:start_display_at',
            'featured_image' => 'required|image',
            'additional_information' => 'sometimes|max:250',
        ]);

        $banner = new Banner();

        $banner->title = $request->title;
        $banner->redirect_url = $request->redirect_url;
        $banner->start_display_at = $request->start_display_at;
        $banner->stop_display_at = $request->stop_display_at;

        if(!$request->display_above_page)
        {
            $banner->is_display_above_page = 0;
        }
        else
        {
            $banner->is_display_above_page = 1;
        }

        if(!$request->display_in_sidebar)
        {
            $banner->is_display_in_sidebar = 0;
        }
        else
        {
            $banner->is_display_in_sidebar = 1;
        }

        if(!$request->display_within_page)
        {
            $banner->is_display_within_page = 0;
        }
        else
        {
            $banner->is_display_within_page = 1;
        }

        if(!$request->display_on_homepage)
        {
            $banner->is_display_on_homepage = 0;
        }
        else
        {
            $banner->is_display_on_homepage = 1;
        }

        if(!$request->display_on_allsegments)
        {
            $banner->is_display_on_allsegments = 0;
        }
        else
        {
            $banner->is_display_on_allsegments = 1;
        }

        if($request->hasFile('featured_image'))
        {
            $originName = $request->file('featured_image')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('featured_image')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            $request->file('featured_image')->move(public_path('media'), $fileName);
            $banner->featured_image =  asset('media/'.$fileName);
        }
        
        $banner->additional_information = $request->additional_information;
        $banner->user_id = $request->user()->id;

        $banner->save();

        if($request->categories)
        {
            $banner->categories()->sync($request->categories);
        }
        
        return back()->with('success_message', 'New banner ad has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        $categories = Category::orderBy('category_name', 'asc')->get();

        return view('banners.show', [
            'banner' => $banner,
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Banner $banner)
    {
        $categories = Category::where('is_active', 1)->orderBy('category_name', 'asc')->get();
        if ($categories->count() < 1)
        {
            $request->session()->put('error_message', 'No post category found. Start by creating one here.');
            return to_route('categories.create');
        }
        $min_timestamp = Carbon::now()->timestamp + (15 * 60);
        $min_time = date('Y-m-d H:i',$min_timestamp);
        
        $min_stop_timestamp = $min_timestamp + (60 * 60 * 24);
        $min_stop_time = date('Y-m-d H:i',$min_stop_timestamp);

        return view('banners.edit', [
            'banner' => $banner,
            'categories' => $categories,
            'min_time' => $min_time,
            'min_stop_time' => $min_stop_time,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        $validated = $request->validate([
            'title' => 'required|max:200',
            'redirect_url' => 'required|max:250',
            'start_display_at' => 'required|date',
            'stop_display_at' => 'required|date|after:start_display_at',
            'featured_image' => 'sometimes|image',
            'additional_information' => 'sometimes|max:250',
        ]);

        $banner = Banner::find($banner->id);

        $banner->title = $request->title;
        $banner->redirect_url = $request->redirect_url;
        $banner->start_display_at = $request->start_display_at;
        $banner->stop_display_at = $request->stop_display_at;

        if(!$request->display_above_page)
        {
            $banner->is_display_above_page = 0;
        }
        else
        {
            $banner->is_display_above_page = 1;
        }

        if(!$request->display_in_sidebar)
        {
            $banner->is_display_in_sidebar = 0;
        }
        else
        {
            $banner->is_display_in_sidebar = 1;
        }

        if(!$request->display_within_page)
        {
            $banner->is_display_within_page = 0;
        }
        else
        {
            $banner->is_display_within_page = 1;
        }

        if(!$request->display_on_homepage)
        {
            $banner->is_display_on_homepage = 0;
        }
        else
        {
            $banner->is_display_on_homepage = 1;
        }

        if(!$request->display_on_allsegments)
        {
            $banner->is_display_on_allsegments = 0;
        }
        else
        {
            $banner->is_display_on_allsegments = 1;
        }
        
        if($request->display_status == 1)
        {
            $banner->is_active = 1;
        }
        else
        {
            $banner->is_active = 0;
        }

        if($request->hasFile('featured_image'))
        {
            $originName = $request->file('featured_image')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('featured_image')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            $request->file('featured_image')->move(public_path('media'), $fileName);
            $banner->featured_image =  asset('media/'.$fileName);
        }
        
        $banner->additional_information = $request->additional_information;
        $banner->user_id = $request->user()->id;

        $banner->save();

        if($request->categories)
        {
            $banner->categories()->sync($request->categories);
        }
        
        return back()->with('success_message', 'Update Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Banner $banner)
    {
        $featured_image = basename($banner->featured_image);

        $banner->delete();

        if (strlen($featured_image) > 2 && File::exists(public_path('media/'.$featured_image)))
        {
            File::delete(public_path('media/'.$featured_image));
        }

        $request->session()->put('success_message', 'Banner ad deleted Successfully.');
    
        return to_route('banners.index');
    }

    /**
     * Quickly Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function quickupdate(Request $request, $id)
    {
        $validated = $request->validate([
            'display_status' => 'required|integer',
            'start_display_at' => 'required|date',
            'stop_display_at' => 'required|date',
        ]);

        $banner = Banner::find($id);
        
        if($request->display_status == 1)
        {
            $banner->is_active = 1;
        }
        else
        {
            $banner->is_active = 0;
        }

        $banner->start_display_at = $request->start_display_at;
        $banner->stop_display_at = $request->stop_display_at;

        $banner->save();
        
        return back()->with('success_message', 'Update saved.');
    }
}
