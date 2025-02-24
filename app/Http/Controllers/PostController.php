<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // Получить все посты
    public function index()
    {
        $posts = Post::with(['user', 'comments.user'])->latest()->get();
        return response()->json($posts);
    }

    // Создать пост
    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required|string|max:1000',
        ]);

        $post = Post::create([
            'user_id' => Auth::id(),
            'text' => $request->text,
            'likes' => 0,
        ]);

        return response()->json($post, 201);
    }

    // Лайкнуть пост
    public function like(Post $post)
    {
        $post->increment('likes');
        return response()->json($post);
    }

    // Добавить комментарий
    public function comment(Request $request, Post $post)
    {
        $request->validate([
            'text' => 'required|string|max:500',
        ]);

        $comment = $post->comments()->create([
            'user_id' => Auth::id(),
            'text' => $request->text,
        ]);

        return response()->json($comment, 201);
    }
}