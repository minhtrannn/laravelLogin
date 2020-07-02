<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Post;
class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        // $title = 'Welcome to LoginSystem';
        // return view('index')->with('title', $title);
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return view('dashboard')->with('posts',$user->posts);
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

}
