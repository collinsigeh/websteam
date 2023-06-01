<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class WebController extends Controller
{
    // Displays the web homepage
    public function welcome()
    {
        $segments = Category::where('is_active', 1)->get();
        $posts = Post::where('is_published', 1)->latest()->take(4)->get();
        $post_blocks = [];

        foreach($segments as $segment)
        {
            if($segment->posts->count() > 0)
            {
                array_push($post_blocks, ['title' => $segment->category_name, 'posts' => Post::where('is_published', 1)->where('primary_category_id', $segment->id)->latest()->take(4)->get()]);
            }
        }

        return view('webhome', [
            'segments' => $segments,
            'posts' => $posts,
            'post_blocks' => $post_blocks,
        ]);
    }

    // Displays the web about page
    public function about()
    {
        $segments = Category::where('is_active', 1)->get();

        return view('about', [
            'segments' => $segments,
        ]);
    }

    // Displays the web contact page
    public function contact()
    {
        $segments = Category::where('is_active', 1)->get();

        return view('contact', [
            'segments' => $segments,
        ]);
    }

    // Displays posts within a category (report segment)
    public function view_segment(Category $category)
    {
        dd($category->id);
    }

    // Displays a specific post
    public function view_post(Post $post)
    {
        dd($post->title);
    }

    // Handles web contact form submission
    public function submitContactForm(ContactRequest $request)
    {
        //Mail::to('admin@penglobalinc.com')->send(new ContactMail($request->name, $request->email, $request->message));

        session(['sent_message' => 'Message Sent! Thanks for contacting us.']);

        return to_route('contact');
    }

    public function newhome()
    {
        return view('newhome');
    }
}
