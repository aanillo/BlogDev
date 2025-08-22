<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Post;
use App\Models\Writer;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // página principal
    public function index()
{
    $recentPosts = Post::with('user') // Cargar la relación user
        ->latest()
        ->take(3)
        ->get()
        ->map(function ($post) {
            return [
                'id' => $post->id,
                'title' => $post->title,
                'excerpt' => \Str::limit(strip_tags($post->post), 120),
                'type' => $post->type,
                'created_at' => $post->created_at->format('d M, Y'),
                'username' => $post->user ? $post->user->username : 'Anónimo'
            ];
        });

    return view('home', compact('recentPosts'));
}




// página principal de admin

public function indexAdmin()
{
    $user = auth()->user();

    if (!$user || $user->rol !== 'admin') {
        abort(403, 'No tienes permiso para acceder a esta página.');
    }

    return view('admin/home', compact('user'));
}

}
