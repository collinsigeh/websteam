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
        $posts = Post::latest()->get();

        return view('welcome', [
            'segments' => $segments,
            'posts' => $posts,
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
}
