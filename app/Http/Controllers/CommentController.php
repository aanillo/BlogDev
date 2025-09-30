<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Comment;
use App\Models\Post;
use App\Notifications\AdminActionNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CommentController extends Controller
{
    
    // publicar comentario

    public function store(Request $request)
{
    $request->validate([
        'comment' => 'required|string|max:1000',
        'post_id' => 'required|exists:posts,id',
        'parent_id' => 'nullable|exists:comments,id',
    ]);

    if ($this->containsBadWords($request->comment)) {
        return back()->withErrors(['comment' => 'El comentario contiene lenguaje inapropiado.'])->withInput();
    }

    $comment = new Comment();
    $comment->comment = $request->comment;
    $comment->publish_date = now();
    $comment->post_id = $request->post_id;
    $comment->user_id = auth()->id();
    $comment->parent_id = $request->parent_id;
    $comment->save();
    
    $post = $comment->post;
    $postAuthor = $post->user;

    if($postAuthor->id !== auth()->id()) {
        $postAuthor->notify(new \App\Notifications\NewCommentNotification($comment));
    }

    if($comment->parent_id) {
        $parentComment = Comment::find($comment->parent_id);
        if($parentComment && $parentComment->user_id !== auth()->id()) {
            $parentComment->user->notify(new \App\Notifications\NewCommentNotification($comment, 'reply'));
        }
    }

    return back()->with('success', 'Comentario publicado');
}

    

    // mostrar comentarios
    
    public function show($id) {
        $post = Post::findOrFail($id);
        $comments = Comment::where('post_id', $id)->orderByDesc('created_at')->get();
    
        return view('commentform', compact('post', 'comments'));
    }


    // eliminar comentario

    public function delete($id)
{
    $comment = Comment::findOrFail($id);

    if (Auth::id() !== $comment->user_id) {
        return back()->withErrors(['error' => 'No tienes permiso para eliminar este comentario.']);
    }

    $comment->delete();
    return back()->with('success', 'Comentario eliminado con éxito.');
}
    

// lista de comentarios

public function indexComments() 
{
    $comments = Comment::with(['post:id,title', 'user:id,username'])->get();
    return view('admin/comments', compact('comments'));
}


// borrar comentario

public function deleteComment($id)
{
    $comment = Comment::findOrFail($id);
    $post = $comment->post;
    
    // Notificar al autor del comentario si es eliminado por admin
    if (auth()->user()->rol === 'admin' && $comment->user_id !== auth()->id()) {
        $commentOwner = $comment->user;
        $commentOwner->notify(new AdminActionNotification(
    $post->title, 
    'Tu comentario ha sido eliminado por un administrador',
    $post->id // Aquí sí podemos pasar el post_id
));
    }
    
    $comment->delete();

    return redirect()->route('admin')->with('success', 'Comentario eliminado correctamente.');
}


// control de lenguaje malsonante u ofensivo

private function containsBadWords($text)
{
    $badWords = [
        'idiota',
        'cabrón',
        'cabrona',
        'tonto',
        'estúpido',
        'me cago en',
        'putas',
        'gilipollas',
        'maricón',
        'maricona',
        'guarra',
        'guarro',
        'mi€rda',
        'carajote',
        'pvta',
        'poya',
        'picha',
        'chocho',
        'tonta',
        'coño',
        'puto',
        'mierda',
        'puta',
        'subnormal',
        'tus muertos',
        'follar',
        'follo',
        'follé',
        'desgraciado',
        'desgraciada'
    ];

    $replacements = [
        'a' => '[a@4]',
        'e' => '[e3]',
        'i' => '[i1!]',
        'o' => '[o0]',
        'u' => '[uü]',
    ];

    foreach ($badWords as &$word) {
        $word = preg_quote($word, '/'); 

        foreach ($replacements as $vowel => $pattern) {
            $word = str_ireplace($vowel, $pattern, $word);
        }
    }
    unset($word); 
    $pattern = '/' . implode('|', $badWords) . '/iu';

    return preg_match($pattern, $text);
}


    


}
