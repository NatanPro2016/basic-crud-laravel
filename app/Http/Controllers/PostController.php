<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;


class PostController extends Controller
{
    public function createPost(Request $request)
    {
        $filds = $request->validate([
            'title' => ['required', 'min:3', 'max:10'],
            'body' => ['required', 'min:3', 'max:1000']
        ]);
        $filds['title'] = strip_tags($filds['title']);
        $filds['body'] = strip_tags($filds['body']);
        $filds['user_id'] = auth()->id();
        Post::create($filds);
        return redirect('/');
    }
    public function showEditSchema(Post $post)
    {
        if (auth()->user()->id !== $post['user_id']) {
            return redirect('/');
        }
        return view('edit-post', ['post' => $post]);
    }
    public function updatePost(Post $post, Request $request)
    {
        if (auth()->user()->id !== $post['user_id']) {
            return redirect('/');
        }
        $filds = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);
        $filds['title'] = strip_tags($filds['title']);
        $filds['body'] = strip_tags($filds['body']);
        $post->update($filds);
        return redirect('/');
    }
    public function deletePost(Post $post)
    {
        if (auth()->user()->id == $post['user_id']) {
          $post->delete();
        }
        return redirect('/');
    }
}
