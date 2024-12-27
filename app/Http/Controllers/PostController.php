<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post; //this represents posts table
use App\Models\Category; //this represents categories table

class PostController extends Controller
{
    private $post;
    private $category;

    public function __construct(Post $post, Category $category)
    {
        $this->post = $post;
        $this->category = $category;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_posts = $this->post->withTrashed()->latest()->get();
        $all_categories = $this->category->all();
        $selected_categories = [];

        foreach($post->categoryPost as $category_post){
            $selected_categories[] = $category_post->category_id;
        }

        return view('admin.posts.index')
            ->with('all_posts', $all_posts)
            ->with('all_categories',$all_categories)
            ->with('selected_categories',$selected_categories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $all_categories = $this->category->all();
        //same as: "SELECT * FROM categories";
        return view('users.posts.create')->with('all_categories',$all_categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        # 1. Validate the data coming from the form first
        $request->validate([
            'category' => 'required|array|between:1,3',
            'description' => 'required|min:1|max:1000',
            'image' => 'required|mimes:jpeg,jpg,png,gif|max:1048'

        ]);

        # 2. Save the post
        $this->post->user_id = Auth::user()->id; //owner of the post
        $this->post->image = 'data:image/' . $request->image->extension() . ';base64,' . base64_encode(file_get_contents($request->image));
        $this->post->description = $request->description;
        $this->post->save(); //post id 1

        # 3. Save categories to the category_post table (PIVOT) table

        // $request->category[1,5,6]
        foreach($request->category as $category_id){
            $category_post[] = ['category_id' => $category_id];
            /**
             * $category_post[1,5,6]
             */
        }
        $this->post->categoryPost()->createMany($category_post); //can accept 2D array
        /**
         *  Given: $this->post->id = 1 
         *         $requset->category1,5,6]
         * After the foreach-loop
         * $category_post[
         *  'category_id' => 1,
         *  'category_id' => 5,
         *  'category_id' => 6,
         * ]
         * 
         * after $this->post->categoryPost()
         * 
         * $category_post[
         *  ['post_id' => 1, 'category_id' => 1,],
         *  ['post_id' => 1, 'category_id' => 5,],
         *  ['post_id' => 1, 'category_id' => 6,],
         * ]
         */

        # 4. Go back to the homepage
        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = $this->post->findOrFail($id);
        $comments = $post->comments()->latest()->take(3)->get();
        $likes = $post->likes()->get();

        return view('users.posts.show')
            ->with('post', $post)
            ->with('comments', $comments)
            ->with('likes', $likes);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post = $this->post->findOrFail($id);
        $all_categories = $this->category->all();
        $selected_categories = [];

        foreach($post->categoryPost as $category_post){
            $selected_categories[] = $category_post->category_id;
        }
        return view('users.posts.edit')
            ->with('all_categories',$all_categories)
            ->with('post', $post)
            ->with('selected_categories',$selected_categories);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        # 1. Validate the data coming from the form first
        // $request->validate([
        //     'category' => 'required|array|between:1,3',
        //     'description' => 'required|min:1|max:1000',
        //     'image' => 'required|mimes:jpeg,jpg,png,gif|max:1048'

        // ]);

        # 2. Save the post
        $post = $this->post->findOrFail($id);
        if($request->image){
            $post->image = 'data:image/' . $request->image->extension() . ';base64,' . base64_encode(file_get_contents($request->image)); 
        }
        
        
        $post->description = $request->description;
        $post->save(); //post id 1

        $post->categoryPost()->delete();

        # 3. Save categories to the category_post table (PIVOT) table

        // $request->category[1,5,6]
        foreach($request->category as $category_id){
            $category_post[] = ['category_id' => $category_id];
            /**
             * $category_post[1,5,6]
             */
        }
        $post->categoryPost()->createMany($category_post); //can accept 2D array

        # 4. Go back to the homepage
        return redirect()->route('post.show', $id);
    }

   

    /**
     * Remove the specified resource from storage.
     */

     public function destroy($id)
    {
        $this->post->destroy($id);
        return redirect()->route('index');
    }
   
}