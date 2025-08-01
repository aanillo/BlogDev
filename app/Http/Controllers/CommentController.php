<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CommentController extends Controller
{
    
    // publicar comentario

    public function store(Request $request) {
        $request->validate([
            'comment' => 'required|string|max:1000',
            'post_id' => 'required|exists:books,id', 
        ], [
            'comment.required' => 'El comentario es obligatorio.',
            'comment.string' => 'El comentario debe ser un texto válido.',
            'comment.max' => 'El comentario no puede tener más de 1000 caracteres.',
            'post_id.required' => 'El identificador del post es obligatorio.',
            'post_id.exists' => 'El post seleccionado no existe.',
        ]);


        if ($this->containsBadWords($request->comment)) {
            return back()->withErrors(['comment' => 'El comentario contiene lenguaje inapropiado.'])->withInput();
        }
    
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->publish_date = now();
        $comment->post_id = $request->post_id;
        $comment->user_id = auth()->id(); 
        $comment->save();
    
        return redirect()->route('showBook', ['id' => $request->post_id]);
    }
    

    // mostrar comentarios
    
    public function show($id) {
        $post = Book::findOrFail($id);
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
    return view('commentsAdminView', compact('comments'));
}


// borrar comentario

public function deleteComment($id)
{
    $comment = Comment::findOrFail($id);
    
    $comment->delete();

    return redirect()->route('admin.comments')->with('success', 'Comentario eliminado correctamente.');
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
