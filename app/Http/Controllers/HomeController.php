<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Post;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $post_views = Post::sum('views');
        $ad_impressions = Banner::sum('impressions');
        $ad_clicks = Banner::sum('clicks');
        $latest_posts = Post::latest()->take(10)->get();
        $popular_posts = Post::orderBy('views', 'desc')->take(10)->get();

        return view('dashboard.home', [
            'post_views' => $post_views,
            'ad_impressions' => $ad_impressions,
            'ad_clicks' => $ad_clicks,
            'latest_posts' => $latest_posts,
            'popular_posts' => $popular_posts,
        ]);
    }

    // Display own profile details
    public function profile(User $user)
    {
        if(auth()->user()->id !== $user->id)
        {
            return to_route('home');
        }
        
        return view('dashboard.profile', [
            'user' => $user,
        ]);
    }

    // Handles change of own profile password
    public function changepassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:6'
        ]);

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with("success_message", "Password changed successfully!");
    }

    // Displays the list of users
    public function users_index()
    {
        if(auth()->user()->is_admin != 1)
        {
            return to_route('home');
        }
        
        $users = User::orderBy('name', 'asc')->paginate(10);

        return view('users.index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function users_edit(User $user)
    {
        if(auth()->user()->is_admin != 1)
        {
            return to_route('home');
        }
        
        return view('users.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function users_update(Request $request, User $user)
    {
        if(auth()->user()->is_admin != 1)
        {
            return to_route('home');
        }
        
        $validated = $request->validate([
            'username' => 'required|unique:users,username,'.$user->id,
            'name' => 'required|max:200',
            'email' => 'required|email|unique:users,email,'.$user->id,
        ]);
        

        if($request->primary_user_role == 1)
        {
            User::where('id', '!=', $user->id)->update(['is_primary_user' => 0]);
            $user->is_primary_user = 1;
            $user->is_active = 1;
            $user->is_author = 1;
            $user->is_editor = 1;
            $user->is_admin = 1;
        }
        elseif($request->primary_user_role == 0 && $request->user()->id == $user->id)
        {
            return back()->with('error_message', 'ERROR - Attempt to disable your "Primary User Role" WITHOUT re-assigning it to another user. The solution is to assign the "Primary User Role" to another user.');
        }
        else
        {
            $user->is_active = $request->account_status;
            $user->is_author = $request->author_role;
            $user->is_editor = $request->editor_role;
            $user->is_admin = $request->admin_role;
        }

        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;

        if(strlen($request->password) > 5)
        {
            $user->password = Hash::make($request->password);
        }

        $user->update();

        return back()->with('success_message', 'Update saved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function users_destroy(Request $request, User $user)
    {
        if(auth()->user()->is_admin != 1)
        {
            return to_route('home');
        }
        
        if($user->id == $request->user()->id)
        {
            return back()->with('error_message', 'ERROR - Own account CANNOT be deleted.');
        }
        if($user->is_primary_user == 1)
        {
            return back()->with('error_message', 'ERROR - Primary user account CANNOT be deleted.');
        }
        if($user->posts->count() > 0 || $user->banners->count() > 0)
        {
            return back()->with('error_message', 'ERROR - User account CANNOT be deleted. It has related resources.');
        }

        $user->delete();
        
        $request->session()->put('success_message', 'User account deleted Successfully.');
    
        return to_route('users.index');
    }

    // Displays settings for update
    public function settings_edit()
    {
        if(auth()->user()->is_admin != 1)
        {
            return to_route('home');
        }

        $setting = Setting::where('name', 'Application')->firstOrFail();

        return view('dashboard.setting', [
            'setting' => $setting,
        ]);
    }

    // Saves settings modifications
    public function settings_update(Request $request)
    {
        $request->validate([
            'production_settings' => 'required|integer'
        ]);

        if($request->production_settings == 1)
        {
            Setting::where('name', 'Application')->update(['is_live' => 1]);
        }
        else
        {
            Setting::where('name', 'Application')->update(['is_live' => 0]);
        }

        return back()->with('success_message', 'Saved!');
    }
}
