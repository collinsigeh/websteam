<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
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

        if(auth()->user()->is_editor != 1)
        {
            return to_route('home');
        }
        
        $categories = Category::latest()->paginate(10);

        return view('categories.index', [
            'categories' => $categories 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->is_active != 1)
        {
            return to_route('deactivated');
        }

        if(auth()->user()->is_editor != 1)
        {
            return to_route('home');
        }
        
        return view('categories.create');
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

        if(auth()->user()->is_editor != 1)
        {
            return to_route('home');
        }
        
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:200',
        ]);

        $category = new Category;

        $category->category_name = $request->category_name;
        $category->slug    = Str::slug($request->category_name, "-");

        $category->save();

        return back()->with('success_message', 'New category has been saved.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        if(auth()->user()->is_active != 1)
        {
            return to_route('deactivated');
        }

        if(auth()->user()->is_editor != 1)
        {
            return to_route('home');
        }
        
        return to_route('categories.edit', $category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        if(auth()->user()->is_active != 1)
        {
            return to_route('deactivated');
        }

        if(auth()->user()->is_editor != 1)
        {
            return to_route('home');
        }
        
        return view('categories.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        if(auth()->user()->is_active != 1)
        {
            return to_route('deactivated');
        }

        if(auth()->user()->is_editor != 1)
        {
            return to_route('home');
        }
        
        $validated = $request->validate([
            'category_name' => 'required|unique:categories,category_name,'.$category->id.',|max:200',
        ]);

        $category->category_name = $request->category_name;
        $category->slug    = Str::slug($request->category_name, "-");

        $category->update();

        return back()->with('success_message', 'Update saved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Category $category)
    {
        if(auth()->user()->is_active != 1)
        {
            return to_route('deactivated');
        }

        if(auth()->user()->is_editor != 1)
        {
            return to_route('home');
        }
        
        $linked_posts = Post::where('primary_category_id', $category->id);

        if($linked_posts->count() > 0)
        {
            return back()->with('error_message', 'ERROR - The category "'.$category->category_name.'" CANNOT be deleted. It has related resources.');
        }

        $category->delete();
        
        $request->session()->put('success_message', 'Category deleted Successfully.');
    
        return to_route('categories.index');
    }
}
