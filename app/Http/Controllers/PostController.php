<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Testing;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Image;

class PostController extends Controller
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
        if(auth()->user()->is_active != 1)
        {
            return to_route('deactivated');
        }

        $posts = Post::latest()->paginate(10);

        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(auth()->user()->is_active != 1)
        {
            return to_route('deactivated');
        }

        if(auth()->user()->is_editor != 1 && auth()->user()->is_author != 1)
        {
            return to_route('home');
        }
        
        $categories = Category::where('is_active', 1)->orderBy('category_name', 'asc')->get();
        if ($categories->count() < 1)
        {
            $request->session()->put('error_message', 'No post category found. Start by creating one here.');
            return to_route('categories.create');
        }
        $min_time = Carbon::now()->timestamp + (60 * 60 * 2);
        $min_time = date('Y-m-d H:i',$min_time);

        return view('posts.create', [
            'categories' => $categories,
            'min_time' => $min_time
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
        if(auth()->user()->is_active != 1)
        {
            return to_route('deactivated');
        }

        if(auth()->user()->is_editor != 1 && auth()->user()->is_author != 1)
        {
            return to_route('home');
        }
        
        $validated = $request->validate([
            'title' => '
                required|unique:posts|max:200
                |not_in:about,contact,donate,home,login,posts,register,segments,submit_contact_form',
            'body' => 'required',
            'featured_image' => 'sometimes|image',
            'tags' => 'sometimes|max:200',
            'primary_category' => 'required|integer',
            'visibility' => 'required|in:public,paid_subscribers,private',
            // commented out for testing= 'publish_at' => 'sometimes|date',
        ]);

        $post = new Post;

        $post->title = $request->title;
        $post->slug = Str::slug($request->title, '-');
        $post->body = $request->body;

        if($request->hasFile('featured_image'))
        {
            $originName = $request->file('featured_image')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('featured_image')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            $request->file('featured_image')->move(public_path('media'), $fileName);
            $post->featured_image =  asset('media/'.$fileName);
        }

        if($request->hasFile('thumbnail_image'))
        {
            $originName = $request->file('thumbnail_image')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('thumbnail_image')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            $request->file('thumbnail_image')->move(public_path('media'), $fileName);
            // $post->thumbnail_image =  asset('media/'.$fileName);
        }

        $post->tags = $request->tags;
        $post->primary_category_id = $request->primary_category;
        $post->visibility = $request->visibility;

        if($request->publish_post)
        {
            $post->is_published = 1;
            $post->published_at = Carbon::now()->toDateTimeString();
        }

        if($request->schedule_publishing)
        {
            $post->is_scheduled = 1;
            $post->publish_at = $request->publish_at;
        }

        $post->user_id = $request->user()->id;

        $post->save();

        if($request->categories)
        {
            $post->categories()->sync($request->categories);
        }
        
        return back()->with('success_message', 'New post has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if(auth()->user()->is_active != 1)
        {
            return to_route('deactivated');
        }

        $categories = Category::orderBy('category_name', 'asc')->get();

        $post->body = str_replace('<figure class="media"><oembed url="https://www.youtube.com/watch?v=', '<iframe width="480" height="270" src="https://www.youtube.com/embed/', $post->body);
        $post->body = str_replace('<figure class="media"><oembed url="https://m.youtube.com/watch?v=', '<iframe width="480" height="270" src="https://www.youtube.com/embed/', $post->body);
        $post->body = str_replace('></oembed></figure>', ' frameborder="0" allowfullscreen></iframe>', $post->body);

        return view('posts.show', [
            'post' => $post,
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Post $post)
    {
        if(auth()->user()->is_active != 1)
        {
            return to_route('deactivated');
        }

        if(auth()->user()->is_editor != 1 && auth()->user()->id != $post->user_id)
        {
            return to_route('home');
        }
        
        $categories = Category::where('is_active', 1)->orderBy('category_name', 'asc')->get();
        if ($categories->count() < 1)
        {
            $request->session()->put('error_message', 'No post category found. Start by creating one here.');
            return to_route('categories.create');
        }
        $min_time = Carbon::now()->timestamp + (60 * 60 * 2);
        $min_time = date('Y-m-d H:i',$min_time);

        return view('posts.edit', [
            'post' => $post,
            'categories' => $categories,
            'min_time' => $min_time
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if(auth()->user()->is_active != 1)
        {
            return to_route('deactivated');
        }

        if(auth()->user()->is_editor != 1 && auth()->user()->id != $post->user_id)
        {
            return to_route('home');
        }
        
        $validated = $request->validate([
            'title' => '
                required|unique:posts,title,'.$post->id.'|max:200
                |not_in:about,contact,donate,home,login,posts,register,segments,submit_contact_form',
            'body' => 'required',
            'featured_image' => 'sometimes|image',
            'tags' => 'sometimes|max:200',
            'primary_category' => 'required|integer',
            'visibility' => 'required|in:public,paid_subscribers,private',
            // commented out for testing= 'publish_at' => 'sometimes|date',
        ]);

        $post->title = $request->title;
        $post->slug = Str::slug($request->title, '-');
        $post->body = $request->body;

        if($request->hasFile('featured_image'))
        {
            $originName = $request->file('featured_image')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('featured_image')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            $request->file('featured_image')->move(public_path('media'), $fileName);
            $post->featured_image =  asset('media/'.$fileName);
        }

        $post->tags = $request->tags;
        $post->primary_category_id = $request->primary_category;
        $post->visibility = $request->visibility;

        if($request->publish_post)
        {
            $post->is_published = 1;
            $post->published_at = Carbon::now()->toDateTimeString();
        }

        if($request->schedule_publishing)
        {
            $post->is_scheduled = 1;
            $post->publish_at = $request->publish_at;
        }

        $post->user_id = $request->user()->id;

        $post->save();

        if($request->categories)
        {
            $post->categories()->sync($request->categories);
        }
        
        return back()->with('success_message', 'Update saved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Post $post)
    {
        if(auth()->user()->is_active != 1)
        {
            return to_route('deactivated');
        }

        if(auth()->user()->is_editor != 1 && auth()->user()->id != $post->user_id)
        {
            return to_route('home');
        }
        
        $featured_image = basename($post->featured_image);

        $post->delete();

        if (strlen($featured_image) > 2 && File::exists(public_path('media/'.$featured_image)))
        {
            File::delete(public_path('media/'.$featured_image));
        }

        $request->session()->put('success_message', 'Post deleted Successfully.');
    
        return to_route('posts.index');
    }

    // Handles ckeditor image upload
    public function upload(Request $request)
    {
        if(auth()->user()->is_active != 1)
        {
            return to_route('deactivated');
        }

        if($request->hasFile('upload'))
        {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            $request->file('upload')->move(public_path('media'), $fileName);
            $url = asset('media/'.$fileName);
            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
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
        if(auth()->user()->is_active != 1)
        {
            return to_route('deactivated');
        }

        $validated = $request->validate([
            'primary_category' => 'required|integer',
            'visibility' => 'required|in:public,paid_subscribers,private',
            'publication_status' => 'required',
        ]);

        $post = Post::find($id);
        
        if(auth()->user()->is_editor != 1 && auth()->user()->is_author != $post->user_id)
        {
            return to_route('home');
        }
        
        $post->primary_category_id = $request->primary_category;
        $post->visibility = $request->visibility;

        if($request->publication_status == 1)
        {
            $post->is_published = 1;
            if($post->published_at == null)
            {
                $post->published_at = Carbon::now()->toDateTimeString();
            }
        }
        else
        {
            $post->is_published = 0;
        }

        $post->save();
        
        return back()->with('success_message', 'Update saved.');
    }

    // Handles search for posts
    public function search(Request $request)
    {
        if(auth()->user()->is_active != 1)
        {
            return to_route('deactivated');
        }

        $search = $request->input('search');

        $posts = Post::query()
        ->where('title', 'LIKE', "%{$search}%")
        ->orWhere('body', 'LIKE', "%{$search}%")
        ->paginate(50);
        
        return view('posts.search', [
            'posts' => $posts,
        ]);
    }
}
