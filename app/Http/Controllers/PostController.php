<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;

class PostController extends Controller
{
    
    public function index()
    {
        $posts = Post::get();
        return view('welcome', ['posts'=>$posts]);
    }

   
    public function create()
    {
        //show the form of create a post
        return view('components.Forms.create');
        // return redirect()->route('posts.index')->with('success','Product created successfully.');
    }

    
    public function store(Request $request)
    {
        //inset into DB
        
        return redirect()->route('posts.index')->with('success','Product created successfully.');
    }

   
    public function show($id)
    {
        //show specific post
        // return redirect()->back();
        return to_route('posts.index');
        // return redirect()->route('posts.index')->with('success','Product created successfully.');
    }

    
    public function edit($id)
    {
        //show the form for specific post to update
        return redirect()->route('posts.show', [$id])->with('success','Product created successfully.');
    }

   
    public function update(Request $request, $id)
    {
        //update the form
        return redirect()->route('posts.show', [$id])->with('success','Product created successfully.');
    }

   
    public function destroy($id)
    {
        //destroy specific post
        return redirect()->route('posts.index')->with('success','Product created successfully.');
    }

    public function renderBlade(){
        //no need to make component just render it directly
        return Blade::render('{{$hello}}', ['hello'=>'katia']);
    }

    public function getUsersPost(User $user, Post $post){
        return view('components.index', ['posts'=>$post]);
        return redirect()->back()->with($request->input('page'));
    }

    public function getAPost(Post $post){
        return $post;
    }

    public function search(User $user, $key){
        $usersPost =  Post::search($key)->query(function($q) use ($user){
            $q->where('user_id', $user->id);
        })->get();
        return $usersPost;
    }
}
