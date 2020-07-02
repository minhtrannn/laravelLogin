<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['auth','verified'], ['except' => ['index','show']]);
    }

    public function index()
    {
        $posts = Post::orderBy('created_at','asc')->get();
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|regex:/^[a-zA-Z ]*$/',
            'body' => 'required|regex:/^[a-zA-Z ]*$/'
        ]);

        $post = new Post();
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->save();

        return redirect('/posts')->with('success', 'Post Created!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($id == null )
        {
            return view('posts.show')->with('error', 'Cannot find user');
        }
        else 
        {
            $post = Post::find($id);
            return view('posts.show')->with('post', $post);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if($id == null )
        {
            return redirect('/posts')->with('error', "Can't find user");
        }
        else 
        {
            $post = Post::find($id);

            //Check for correct user 
            if(auth()->user()->id !== $post->user_id)
            {
                return redirect('/posts')->with('error', 'Unauthorized');
            }
            return view('posts.edit')->with('post', $post);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => 'required|regex:/^[a-zA-Z ]*$/',
            'body' => 'required'
        ]);
        $post = Post::find($id);
        if($post == null)
        {
            return redirect('/posts')->with('success', 'Cannot update post!!');
        }
        else 
        {
            $post->title = $request->input('title');
            $post->body = $request->input('body');
            $post->save();
        }

        return redirect('/posts')->with('success', 'Update Success!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id == null )
        {
            return redirect('/posts')->with('error', "Can't remove post");
        }
        else 
        {
            $post = Post::find($id);
            $post->delete();
    
            return redirect('/posts')->with('success', 'Remove Success!!');
        }
    }
}
