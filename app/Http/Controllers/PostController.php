<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Guest $guest)
    {
        $posts = $guest->posts()->latest()->get();
        return view('guests.posts.index', compact('guest', 'posts'));
    }

    public function create(Guest $guest)
    {
        return view('guests.posts.form', compact('guest'));
    }

    public function store(Request $request, Guest $guest)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        $guest->posts()->create($data);

        return redirect()
            ->route('guests.posts.index', $guest)
            ->with('success', 'Post created successfully.');
    }

    public function edit(Guest $guest, Post $post)
    {
        abort_unless($post->guest_id == $guest->id, 404);

        return view('guests.posts.form', compact('guest', 'post'));
    }

    public function update(Request $request, Guest $guest, Post $post)
    {
        abort_unless($post->guest_id == $guest->id, 404);

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        $post->update($data);

        return redirect()
            ->route('guests.posts.index', $guest)
            ->with('success', 'Post updated successfully.');
    }

    public function destroy(Guest $guest, Post $post)
    {

        $post->delete();

        return redirect()->route('guests.posts.index', $guest)->with('success', 'Post deleted successfully.');
    }
}
