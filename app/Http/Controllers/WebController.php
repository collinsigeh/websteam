<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class WebController extends Controller
{
    // Displays the web homepage
    public function welcome()
    {
        $segments = Category::where('is_active', 1)->get();
        $posts = Post::where('is_published', 1)->latest()->take(4)->get();
        $popular_posts = Post::where('is_published', 1)->orderBy('views', 'desc')->take(8)->get();
        $post_blocks = [];

        foreach($segments as $segment)
        {
            if($segment->posts->count() > 0)
            {
                array_push($post_blocks, ['title' => $segment->category_name, 'posts' => Post::where('is_published', 1)->where('primary_category_id', $segment->id)->latest()->take(4)->get()]);
            }
        }
        
        $now = Carbon::now()->toDateTimeString();

        $above_page_ad = Banner::where('is_display_above_page', 1)
                            ->where('is_active', 1)
                            ->where('is_display_on_homepage', 1)
                            ->where('start_display_at', '<=', $now)
                            ->where('stop_display_at', '>=', $now)
                            ->get()->shuffle()->first();

        if($above_page_ad)
        {
            $ap_ad = Banner::find($above_page_ad->id);
            $ap_ad->impressions = $ap_ad->impressions + 1;
            $ap_ad->save();
        }
                            
        $sidebar_ad = Banner::where('is_display_in_sidebar', 1)
                            ->where('is_active', 1)
                            ->where('is_display_on_homepage', 1)
                            ->where('start_display_at', '<=', $now)
                            ->where('stop_display_at', '>=', $now)
                            ->get()->shuffle()->first();

        if($sidebar_ad)
        {
            $s_ad = Banner::find($sidebar_ad->id);
            $s_ad->impressions = $s_ad->impressions + 1;
            $s_ad->save();
        }
                            
        $within_page_ad = Banner::where('is_display_within_page', 1)
                            ->where('is_active', 1)
                            ->where('is_display_on_homepage', 1)
                            ->where('start_display_at', '<=', $now)
                            ->where('stop_display_at', '>=', $now)
                            ->get()->shuffle()->first();

        if($within_page_ad)
        {
            $wp_ad = Banner::find($above_page_ad->id);
            $wp_ad->impressions = $wp_ad->impressions + 1;
            $wp_ad->save();
        }

        return view('webhome', [
            'segments' => $segments,
            'posts' => $posts,
            'popular_posts' => $popular_posts,
            'post_blocks' => $post_blocks,
            'above_page_ad' => $above_page_ad,
            'sidebar_ad' => $sidebar_ad,
            'within_page_ad' => $within_page_ad,
        ]);
    }

    // Displays the web about page
    public function about()
    {
        $segments = Category::where('is_active', 1)->get();

        return view('about', [
            'segments' => $segments,
            'above_page_ad' => null,
            'sidebar_ad' => null,
            'within_page_ad' => null,
        ]);
    }

    // Displays the web contact page
    public function contact()
    {
        $segments = Category::where('is_active', 1)->get();

        return view('contact', [
            'segments' => $segments,
            'above_page_ad' => null,
            'sidebar_ad' => null,
            'within_page_ad' => null,
        ]);
    }

    // Displays posts within a category (report segment)
    public function view_segment(Category $category)
    {
        dd($category->id);

        $segments = Category::where('is_active', 1)->get();

        return view('contact', [
            'segments' => $segments,
            'above_page_ad' => null,
            'sidebar_ad' => null,
            'within_page_ad' => null,
        ]);
    }

    // Displays a specific post
    public function view_post(Post $post)
    {
        $post->views = $post->views + 1;
        $post->save();
        
        $more_reads = Post::where('id', '!=', $post->id)->where('primary_category_id', $post->primary_category_id)->latest()->take(4)->get();
        $latest_posts = Post::where('is_published', 1)->latest()->take(8)->get();
        $popular_posts = Post::where('is_published', 1)->orderBy('views', 'desc')->take(8)->get();
        $segments = Category::where('is_active', 1)->get();
        
        $now = Carbon::now()->toDateTimeString();

        $above_page_ad = Banner::where('is_display_above_page', 1)
                            ->where('is_active', 1)
                            ->where('is_display_on_homepage', 1)
                            ->where('start_display_at', '<=', $now)
                            ->where('stop_display_at', '>=', $now)
                            ->get()->shuffle()->first();

        if($above_page_ad)
        {
            $ap_ad = Banner::find($above_page_ad->id);
            $ap_ad->impressions = $ap_ad->impressions + 1;
            $ap_ad->save();
        }
                            
        $sidebar_ad = Banner::where('is_display_in_sidebar', 1)
                            ->where('is_active', 1)
                            ->where('is_display_on_homepage', 1)
                            ->where('start_display_at', '<=', $now)
                            ->where('stop_display_at', '>=', $now)
                            ->get()->shuffle()->first();

        if($sidebar_ad)
        {
            $s_ad = Banner::find($sidebar_ad->id);
            $s_ad->impressions = $s_ad->impressions + 1;
            $s_ad->save();
        }
                            
        $within_page_ad = Banner::where('is_display_within_page', 1)
                            ->where('is_active', 1)
                            ->where('is_display_on_homepage', 1)
                            ->where('start_display_at', '<=', $now)
                            ->where('stop_display_at', '>=', $now)
                            ->get()->shuffle()->first();

        if($within_page_ad)
        {
            $wp_ad = Banner::find($above_page_ad->id);
            $wp_ad->impressions = $wp_ad->impressions + 1;
            $wp_ad->save();
        }

        return view('post_view', [
            'post' => $post,
            'more_reads' => $more_reads,
            'latest_posts' => $latest_posts,
            'popular_posts' => $popular_posts,
            'segments' => $segments,
            'above_page_ad' => $above_page_ad,
            'sidebar_ad' => $sidebar_ad,
            'within_page_ad' => $within_page_ad,
        ]);
    }

    // Handles web contact form submission
    public function submitContactForm(ContactRequest $request)
    {
        //Mail::to('admin@penglobalinc.com')->send(new ContactMail($request->name, $request->email, $request->message));

        session(['sent_message' => 'Message Sent! Thanks for contacting us.']);

        return to_route('contact');
    }

    /**
     * Handles the redirection of clicks.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function redirect($id)
    {
        $banner = Banner::find($id);

        if($banner)
        {
            $banner->clicks = $banner->clicks + 1;
            $banner->save();
            //dd($banner->redirect_url);
            return redirect($banner->redirect_url);
        }
        else
        {
            return to_route('welcome');
        }
    }
}
