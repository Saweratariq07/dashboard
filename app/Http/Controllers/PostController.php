<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Display a listing of the posts
    public function index(Request $request)
    {
        $query = Post::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
        }

        $posts = $query->get(); // Fetch the filtered posts from the database
        return view('index', compact('posts')); // Return the view with the posts
    }

    // Show the form for creating a new post
    public function create()
    {
        return view('create'); // Return the view for creating a post
    }

    // Store a newly created post in the database
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        // Create a new post
        Post::create($request->only('title', 'content'));

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    // Display a single post
    public function show(Post $post)
    {
        return view('show', compact('post')); // Return the view for a single post
    }

    // Show the form for editing an existing post
    public function edit(Post $post)
    {
        return view('edit', compact('post')); // Return the view for editing the post
    }

    // Update the specified post in the database
    public function update(Request $request, Post $post)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        // Update the post
        $post->update($request->only('title', 'content'));

        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }

    // Remove the specified post from the database
    public function destroy(Post $post)
    {
        $post->delete(); // Delete the post
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }
}
