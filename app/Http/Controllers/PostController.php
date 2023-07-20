<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
     public function index(Request $request)
     {
        $search = $request->input('search');
        if(is_null($search)){
            $posts = Post::with('users', 'categories')->where('user_id', '=', Auth::id())->paginate(10);
        }else{
            // dd($search);
            $posts = Post::whereHas('categories', function($query) use ($search){
                return $query->where('title', 'like', '%' .$search. '%');
            })->orWhereHas('users', function($query) use ($search){
                return $query->where('name', 'like', '%' .$search. '%');
            })
            ->orWhere('title', 'like', '%' .$search. '%')
            ->orWhere('content', 'like', '%' .$search. '%')
            ->where('user_id', '=', Auth::id())->paginate(10);
        }
        // dd($posts);
        // if($search != null){
        //     $posts = DB::table('posts')
        //                 ->select('posts.*', 'users.name as userName', 'categories.title as categoryTitle')
        //                 ->join('users','users.id','posts.user_id')
        //                 ->join('categories','categories.id','posts.category_id')
        //                 ->where('posts.user_id', '=', Auth::id())
        //                 ->orWhere('posts.title', 'like', '%' .$search. '%')
        //                 ->orWhere('posts.content', 'like', '%' .$search. '%')
        //                 ->orWhere('users.name', 'like', '%' .$search. '%')
        //                 ->orWhere('categories.title', 'like', '%' .$search. '%')
        //                 ->paginate(10);
        //                 // dd($posts);
        // }else{
        //     $posts = DB::table('posts')
        //         ->select('posts.*', 'users.name as userName', 'categories.title as categoryTitle')
        //         ->join('users','users.id','posts.user_id')
        //         ->join('categories','categories.id','posts.category_id')
        //         ->where('posts.user_id', '=', Auth::id())
        //         ->paginate(10);
        // }
        
        return view('post.index', compact('posts'));
     }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required',
        ]);

        $post = new Post();

        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        $post->user_id = $request->user_id;
        
        $post->save();
        $post->categories()->attach($request->category_id);
        // dd($post);
        return redirect()->route('posts.index');
        //return redirect()->back()->with('success', 'Post created successfully!');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post = Post::with('categories')->find($id);
        // dd($post);
        // dd($post->id);
        $categories = Category::get();

        // $post = DB::table('posts')
        //                 ->select('posts.*', 'users.name as userName', 'categories.title as categoryTitle')
        //                 // ->join('category_post', 'category_post.post_id', 'posts.id')
        //                 ->join('categories', 'categories.id', 'posts.category_id')
        //                 ->join('users', 'users.id', 'posts.user_id')
        //                 ->where('posts.id', '=', "$id")
        //                 ->first();
        //  dd($post->id);
        //$category = Category::find($post->category_id);
        return view('post.update', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required',
        ]);

        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;

        $post->save();
        $post = Post::find($id);

        //return view('post.show', compact('post'));
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Post::where('id', $id)->delete();
        
        $posts = Post::with('users', 'categories')
                        ->where('user_id', '=', Auth::id())->paginate(10);
        
        return view('post.index', compact('posts'));
    }
    public function listing(Request $request)
    {
        $search = $request->input('search');

        if(is_null($search)){
            $posts = Post::with('users', 'categories')->paginate(10);
        }else{
            // dd($search);
            $posts = Post::whereHas('categories', function($query) use ($search){
                return $query->where('title', 'like', '%' .$search. '%');
            })->orWhereHas('users', function($query) use ($search){
                return $query->where('name', 'like', '%' .$search. '%');
            })
            ->orWhere('title', 'like', '%' .$search. '%')
            ->orWhere('content', 'like', '%' .$search. '%')->paginate(10);
        }

        // if($search != null){  
        //     $posts = DB::table('posts')
        //             ->select('posts.*', 'users.name as userName', 'categories.title as categoryTitle')
        //             ->join('users','users.id','posts.user_id')
        //             ->join('categories','categories.id','posts.category_id')
        //             ->orWhere('posts.title', 'like', '%' .$search. '%')
        //             ->orWhere('posts.content', 'like', '%' .$search. '%')
        //             ->orWhere('users.name', 'like', '%' .$search. '%')
        //             ->orWhere('categories.title', 'like', '%' .$search. '%')
        //             // ->where('posts.user_id', '=', Auth::id())
        //             ->paginate(10);
        //             // dd($posts);
        // }else{
        //     $posts = DB::table('posts')
        //                 ->select('posts.*', 'users.name as userName', 'categories.title as categoryTitle')
        //                 ->join('users','users.id','posts.user_id')
        //                 ->join('categories','categories.id','posts.category_id')
        //                 // ->where('posts.user_id', '=', Auth::id())
        //                 ->paginate(10);
        // }            
        return view('post.listing', compact('posts'));
    }
}
