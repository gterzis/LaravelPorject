<?php

namespace App\Http\Controllers;

use App\Category;
use App\PostCategory;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;


class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('title','desc')->paginate(3); //fetch all posts from database. Show 3 per page.
        return view('pages.posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('title','desc')->pluck('title','title');
        return view('pages.posts.create')->with('categories', $categories);
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
            'title' => 'required',
            'subtitle' => 'required',
            'slug' => 'required',
            'content' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);
        // Handle File Upload
        if($request->hasFile('cover_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }
        // Create Post
        $post = new Post;
        $post->title = $request->input('title');
        $post->subtitle = $request->input('subtitle');
        $post->slug = $request->input('slug');
        $post->content = $request->input('content');
        $post->cover_image = $fileNameToStore;
        $post->save();

        //Add categories to the created post
        $selectedCategories = Input::get('categories');
        if (!empty($selectedCategories)) {
            foreach ($selectedCategories as $selectedCategory) {
                $postCategory = new PostCategory;
                $category = DB::table('categories')->where('title', $selectedCategory)->first(); // find the category's details
                $postCategory->category_id = $category->id;
                $postCategory->post_id = $post->id;
                $postCategory->save();
            }
        }
        return redirect('/posts')->with('success', 'Post created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $categories = DB::table('post_categories')->join('categories', 'post_categories.category_id', '=', 'categories.id')->where('post_id', $id)->get();
        return view('pages.posts.show')->with('data',['post' => $post, 'categories' => $categories ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        //Check if post exists before deleting
        if (!isset($post)){
            return redirect('/posts')->with('error', 'No Post Found');
        }

        $categories = Category::orderBy('title','desc')->pluck('title','title');

        return view('pages.posts.edit')->with('data',['post' => $post, 'categories' => $categories ]);

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
        $this->validate($request, [
            'title' => 'required',
            'subtitle' => 'required',
            'slug' => 'required',
            'content' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);
        // Handle File Upload
        if($request->hasFile('cover_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }
        // Update Post
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->subtitle = $request->input('subtitle');
        $post->slug = $request->input('slug');
        $post->content = $request->input('content');
        $post->cover_image = $fileNameToStore;
        $post->save();

        //Add categories to the post
        $selectedCategories = Input::get('categories');
        if (!empty($selectedCategories)) {
            foreach ($selectedCategories as $selectedCategory) {
                $postCategory = new PostCategory;
                $category = DB::table('categories')->where('title', $selectedCategory)->first(); // find the category's details
                $postCategory->category_id = $category->id;
                $postCategory->post_id = $id;
                $postCategory->save();
            }
        }

        return redirect('/posts')->with('success', 'Post Updated');    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect('/posts')->with('success', 'Post Removed');
    }
}
