<?php

namespace App\Http\Controllers\Controller;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //
    public function getPostsByType($type)
{
    $validTypes = ['Inicio', 'Tecnología', 'Experiencia', 'Opinión'];

    if (!in_array($type, $validTypes)) {
        return redirect()->back();
    }

    $posts = Post::where('type', $type)->get();

    return view('postsByTypeView', compact('posts', 'type'));
}


    public function showPost($id) {
        $post = Post::with('comments.user')->findOrFail($id);
        return view('postView', compact('post'));
    }

    public function indexPosts() {
        $posts = Post::all();
        return view('postsAdminView', compact('posts'));
    }

    public function showInsert() {
        return view('insertPostView');
    }

    public function doInsert(Request $request) {
       $validator = Validator::make($request->all(), [
        'title' => 'required|string|max:255',
        'type' => 'required|in:Inicio,Tecnología,Experiencia,Opinión',
        'post'  => 'required|string|min:10'
    ], [
        'title.required' => 'El título es obligatorio.',
        'title.string' => 'El título debe ser una cadena de texto.',
        'title.max' => 'El título no puede superar los 255 caracteres.',

        'type.required' => 'El tipo es obligatorio.',
        'type.in' => 'El tipo debe ser uno de los siguientes: Inicio, Tecnología, Experiencia u Opinión.',

        'post.required' => 'El contenido del post es obligatorio.',
        'post.string' => 'El contenido debe ser una cadena de texto.',
        'post.min' => 'El post debe contener un mínimo de 10 caracteres.'
    ]);

        if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
        }

        $post = new Post();
        $post->title = $request->title;
        $post->type = $request->type;
        $post->publish_date = now();
        $post->post = $request->now();
        $post->user_id = auth()->id(); 
        $post->save();
        return redirect()->route('showInsertPost')->with('succes', 'Post insertado correctamente');
    }

    public function delete($id) {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect() -> route('posts.show')->with('success', 'El post ha sido eliminado correctamente');
    }
    
}
