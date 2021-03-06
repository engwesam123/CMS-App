<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostsRequest;
use App\Http\Requests\UpdateRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts', Post::all());

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
    public function store(PostsRequest $request)
    {

        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => $request->image->store('images', 'public')
        ]);

        session()->flash('success', 'Post created successfully');

        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')->with('post', $post);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Post $post)
    {
        $data = $request->only(['title', 'description', 'content']);
        if ($request->hasFile('image')){
            $image = $request->image->store('images', 'public');
            Storage::disk('public')->delete($post->image);
            $data['image'] = $image;
        }
        $post->update($data);

        session()->flash('success', 'Post created successfully');

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $post = Post::withTrashed()->where('id', $id)->first();
        if ($post->trashed()){
            $post->forceDelete();
            Storage::disk('public')->delete($post->image);

        }else{
            $post->delete();
        }
        session()->flash('success', 'Post created successfully');
        return redirect(route('posts.index'));
    }

    public function trashed(){
        $trashed = Post::onlyTrashed()->get();
        return view('posts.index')->with('posts', $trashed);
    }
}
