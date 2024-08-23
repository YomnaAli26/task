<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::where('user_id',Auth::id())->paginate(10);
        return $this->getResponse(message: "Posts retrieved successfully",
            data:PostResource::collection($posts),
            paginator: $posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image'))
        {
            $data['image'] = uploadImage($request->file('image'),'posts');
        }
        $data['user_id'] = auth()->user()->id;
        $post = Post::create($data);
        return $this->getResponse(201, "Post created successfully",
        PostResource::make($post));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        if (auth()->user()->cannot('view', $post)) {
            return $this->getResponse(Response::HTTP_FORBIDDEN,'You do not have permission to delete this post');
        }

        return $this->getResponse(message: "Post retrieved successfully",data: PostResource::make($post));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        if (auth()->user()->cannot('update', $post)) {
            return $this->getResponse(Response::HTTP_FORBIDDEN,'You do not have permission to delete this post');
        }
        $data =$request->validated();
        if ($request->hasFile('image'))
        {
            $oldImagePath = $post->image;
            $data['image'] = uploadImage($request->file('image'),'posts');
            if ($oldImagePath)
            {
                Storage::disk('public')->delete($oldImagePath);
            }
        }
        $post->update($data);
        return $this->getResponse( message: "Post updated successfully",data: PostResource::make($post));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {

        if (auth()->user()->cannot('delete', $post)) {
            return $this->getResponse(Response::HTTP_FORBIDDEN,'You do not have permission to delete this post');
        }
        if ($post->image)
        {
            Storage::disk('public')->delete($post->image);
        }
        $post->delete();
        return $this->getResponse(message: "Post deleted successfully");
    }
}
