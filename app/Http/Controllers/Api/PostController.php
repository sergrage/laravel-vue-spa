<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Requests\CreatePostRequest;
use App\Models\Post;

class PostController extends Controller
{
    public function index() {
        $sortField = \request('sort_field', 'created_at');
        if(!in_array($sortField, ['title', 'text', 'created_at'])) {
            $sortField = 'created_at';
        }
        $sortDirection = \request('sort_direction', 'desc');
        if(!in_array($sortDirection, ['desc', 'asc'])) {
            $sortDirection = 'desc';
        }

        $post = Post::when(request('category_id', '') != '', function($query){
            $query->where('category_id', request('category_id'));
        })->orderBy($sortField, $sortDirection)->paginate(3);
        return PostResource::collection($post);
    }

    public function store(CreatePostRequest $request){
        sleep(5);

        if($request->hasFile('thumbnail')) {
            $filename = $request->thumbnail->getClientOriginalName();
            info($filename);
        }

        $post = Post::create($request->validated());
        return new PostResource($post);
    }

    public function show(Post $post){
        return new PostResource($post);
    }

    public function update(Post $post, CreatePostRequest $request) {
        $post->update($request->validated());
        return new PostResource($post);
    }

    public function destroy(Post $post) {
        $post->delete();
        return response()->noContent();
    }
}

