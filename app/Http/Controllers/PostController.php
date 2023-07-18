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
        // dd($search);
        $userId = Auth::id();
        
        // dd($posts);
        $posts = Post::with('users', 'categories')
                        ->whereHas('categories', function ($query) use ($search) 
                            {
                                $query->orWhere('title', 'like', '%' .$search. '%');
                            })
                        ->whereHas('users', function ($query) use ($search) 
                        {
                            $query->where('name', 'like', '%' .$search. '%');
                        })->where('user_id', '=', Auth::id())->paginate(10);
        // $posts = DB::table('posts')
        //                 ->select('posts.*', 'users.name', 'categories.title')
        //                 ->join('users','users.id','posts.user_id')
        //                 ->join('category_post','category_post.post_id','posts.id')
        //                 ->join('category_post','category_post.category_id','categories.id')
        //                 ->where('posts.user_id', '=', $userId)
        //                 ->where('title','LIKE', "%{$search}%")
        //                 ->where('content', 'LIKE', "%{$search}%")
        //                 ->paginate(10);
        // dd($posts);
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
        ]);

        $post = new Post();

        $post->title = $request->title;
        $post->content = $request->content;

        $post->user_id = Auth::user()->id;

        $post->save();
        $post->categories()->attach($request->category_id);

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
        $post = Post::find($id);
        $categories = Category::get();
        //$post = Post::find($id)->with('categories')->get();
        $post = DB::table('posts')
                        ->join('category_post', 'category_post.post_id', 'posts.id')
                        ->where('posts.id', '=', "$id")
                        ->get();
        //$category = Category::find($post->category_id);
        return view('post.update', compact('post','categories'));
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
        ]);

        $post->title = $request->title;
        $post->content = $request->content;

        $post->save();
        $post = Post::find($id);

        //return view('post.show', compact('post'));
        return redirect()->route('posts.index')->with('success', 'Post Has Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Post::where('id', $id)->delete();
        return redirect()->back();
    }
    public function listing(Request $request)
    {
        $search = $request->input('search');
        // dd($search);
        $userId = Auth::id();
        $posts = Post::query()->where('title','LIKE', "%{$search}%")
                            ->orWhere('content', 'LIKE', "%{$search}%")->get();
                    
        return view('post.listing', compact('posts'));
    }
}
