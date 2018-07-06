<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class Posts extends Controller
{
    function index(Request $request)
    {
        $posts = Post::get();
        $response = [];

        foreach ($posts as $post) {
            $response[] = [
                'resource' => 'api/posts/' . $post->id,
                'methods' => [
                    'GET',
                    'PUT',
                    'DELETE'
                ],
                'id' => $post->id,
                'title' => $post->title,
                'slug' => $post->slug,
                'published' => $post->published,
                'description' => $post->description,
                'body' => $post->body,
                'created_at' => $post->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $post->updated_at->format('Y-m-d H:i:s'),
                'deleted_at' => (isset($post->deleted_at) ? $post->deleted_at->format('Y-m-d H:i:s') : null)
            ];
        }

        return response()->json(['data' => $response]);
    }

    function fetch(Request $request, Post $post)
    {
        $post->load('comments');

        $response = [
            'resource' => 'api/posts/' . $post->id,
            'methods' => [
                'GET',
                'PUT',
                'DELETE'
            ],
            'id' => $post->id,
            'title' => $post->title,
            'slug' => $post->slug,
            'published' => $post->published,
            'description' => $post->description,
            'body' => $post->body,
            'comments' => $post->comments,
            'created_at' => $post->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $post->updated_at->format('Y-m-d H:i:s'),
            'deleted_at' => (isset($post->deleted_at) ? $post->deleted_at->format('Y-m-d H:i:s') : null)
        ];

        return response()->json(['data' => $response]);
    }

    function create(Request $request)
    {
        $data = $request->only(['title', 'published', 'description', 'body']);
        $slug = ['slug' => str_slug($request->title)];
        $data = array_merge($data, $slug);
        $post = Post::create($data);

        $response = [
            'resource' => 'api/posts/' . $post->id,
            'methods' => [
                'GET',
                'PUT',
                'DELETE'
            ],
            'id' => $post->id,
            'title' => $post->title,
            'slug' => $post->slug,
            'published' => $post->published,
            'description' => $post->description,
            'body' => $post->body,
            'created_at' => $post->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $post->updated_at->format('Y-m-d H:i:s'),
            'deleted_at' => (isset($post->deleted_at) ? $post->deleted_at->format('Y-m-d H:i:s') : null)
        ];

        return response()->json(['data' => $response]);
    }

    function update(Request $request, Post $post)
    {
        $data = $request->only(['title', 'published', 'description', 'body']);
        $slug = ['slug' => str_slug($request->title)];
        $data = array_merge($data, $slug);


        $post->update($data);

        $response = [
            'resource' => 'api/posts/' . $post->id,
            'methods' => [
                'GET',
                'PUT',
                'DELETE'
            ],
            'id' => $post->id,
            'title' => $post->title,
            'slug' => $post->slug,
            'published' => $post->published,
            'description' => $post->description,
            'body' => $post->body,
            'created_at' => $post->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $post->updated_at->format('Y-m-d H:i:s'),
            'deleted_at' => (isset($post->deleted_at) ? $post->deleted_at->format('Y-m-d H:i:s') : null)
        ];

        return response()->json(['data' => $response]);
    }

    function delete(Request $request, Post $post)
    {
        $post->delete();
        return response('', 200);
    }

    function comment(Request $request, Post $post)
    {
        $post->comments()->create($request->only(['name', 'email', 'comment']));
        return response('', 201);
    }
}
