<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        //
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
        $min_time = Carbon::now()->timestamp + (60 * 60 * 2);
        $min_time = date('Y-m-d H:i',$min_time);
        
        $min_stop_time = Carbon::now()->timestamp + (60 * 60 * 26);
        $min_stop_time = date('Y-m-d H:i',$min_stop_time);

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
        dd('I got here');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        //
    }
}
