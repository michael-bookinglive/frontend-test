<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;

class Pages extends Controller
{
    function index(Request $request)
    {
        $pages = Page::get();
        $response = [];

        foreach ($pages as $page) {
            $response[] = [
                'resource' => 'api/pages/' . $page->id,
                'methods' => [
                    'GET',
                    'PUT',
                    'DELETE'
                ],
                'id' => $page->id,
                'title' => $page->title,
                'slug' => $page->slug,
                'published' => $page->published,
                'description' => $page->description,
                'body' => $page->body,
                'created_at' => $page->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $page->updated_at->format('Y-m-d H:i:s'),
                'deleted_at' => (isset($post->deleted_at) ? $post->deleted_at->format('Y-m-d H:i:s') : null)
            ];
        }

        return response()->json(['data' => $response]);
    }

    function fetch(Request $request, Page $page)
    {
        $response = [
            'resource' => 'api/pages/' . $page->id,
            'methods' => [
                'GET',
                'PUT',
                'DELETE'
            ],
            'id' => $page->id,
            'title' => $page->title,
            'slug' => $page->slug,
            'published' => $page->published,
            'description' => $page->description,
            'body' => $page->body,
            'created_at' => $page->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $page->updated_at->format('Y-m-d H:i:s'),
            'deleted_at' => (isset($post->deleted_at) ? $post->deleted_at->format('Y-m-d H:i:s') : null)
        ];

        return response()->json(['data' => $response]);
    }

    function create(Request $request)
    {
        $data = $request->only(['title', 'published', 'description', 'body']);
        $slug = ['slug' => str_slug($request->title)];
        $data = array_merge($data, $slug);
        $page = Page::create($data);

        $response = [
            'resource' => 'api/pages/' . $page->id,
            'methods' => [
                'GET',
                'PUT',
                'DELETE'
            ],
            'id' => $page->id,
            'title' => $page->title,
            'slug' => $page->slug,
            'published' => $page->published,
            'description' => $page->description,
            'body' => $page->body,
            'created_at' => $page->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $page->updated_at->format('Y-m-d H:i:s'),
            'deleted_at' => (isset($post->deleted_at) ? $post->deleted_at->format('Y-m-d H:i:s') : null)
        ];

        return response()->json(['data' => $response]);
    }

    function update(Request $request, Page $page)
    {
        $data = $request->only(['title', 'published', 'description', 'body']);
        $slug = ['slug' => str_slug($request->title)];
        $data = array_merge($data, $slug);
        $page->update($data);

        $response = [
            'resource' => 'api/pages/' . $page->id,
            'methods' => [
                'GET',
                'PUT',
                'DELETE'
            ],
            'id' => $page->id,
            'title' => $page->title,
            'slug' => $page->slug,
            'published' => $page->published,
            'description' => $page->description,
            'body' => $page->body,
            'created_at' => $page->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $page->updated_at->format('Y-m-d H:i:s'),
            'deleted_at' => (isset($post->deleted_at) ? $post->deleted_at->format('Y-m-d H:i:s') : null)
        ];

        return response()->json(['data' => $response]);
    }

    function delete(Request $request, Page $page)
    {
        $page->delete();
        return response('', 200);
    }
}
