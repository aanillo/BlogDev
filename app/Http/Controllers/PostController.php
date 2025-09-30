<?php

namespace App\Http\Controllers;


use App\Models\Post;
use App\Notifications\AdminActionNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

    $posts = Post::with('user') 
    ->where('type', $type)
    ->get();

    switch ($type) {
        case 'Inicio':
            return view('post/inicio', compact('posts', 'type'));
        case 'Tecnología':
            return view('post/tecnologia', compact('posts', 'type'));
        case 'Experiencia':
            return view('post/experiencia', compact('posts', 'type'));
        case 'Opinión':
            return view('post/opinion', compact('posts', 'type'));
        default:
            return redirect()->back();
    }
}


    public function showPost($id) {
        $post = Post::with('comments.user')->findOrFail($id);
        return view('post/showPost', compact('post'));
    }

    public function indexPosts() {
        $posts = Post::all();
        return view('admin/posts', compact('posts'));
    }

    public function showInsert() {
        return view('post/insert');
    }

    public function doInsert(Request $request)
{
    $validator = Validator::make($request->all(), [
        'title' => 'required|string|max:255',
        'type'  => 'required|in:Inicio,Tecnología,Experiencia,Opinión',
        'post'  => 'required|string|min:10',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ], [
        'title.required' => 'El título es obligatorio.',
        'title.string'   => 'El título debe ser un texto válido.',
        'title.max'      => 'El título no puede superar los 255 caracteres.',
        'type.required'  => 'El tipo es obligatorio.',
        'type.in'        => 'El tipo seleccionado no es válido. Solo se permiten Inicio, Tecnología, Experiencia u Opinión.',
        'post.required'  => 'El contenido del post es obligatorio.',
        'post.min'       => 'El post debe tener mínimo 10 caracteres.',
        'image.image'    => 'El archivo debe ser una imagen.',
        'image.mimes'    => 'La imagen debe ser jpeg, png, jpg, gif o svg.',
        'image.max'      => 'La imagen no puede superar los 2MB.'
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $content = $request->post;

    // Subir imagen si hay
     if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('posts', 'public');
        $imageUrl = asset('storage/' . $imagePath);
        $content .= "\n[IMG]{$imageUrl}[/IMG]";
    }


    $post = new Post();
    $post->title = $request->title;
    $post->type = $request->type;
    $post->publish_date = now();
    $post->post = $content; 
    $post->user_id = auth()->id();
    $post->save();

    return redirect()->route('show', ['id' => $post->id])->with('success', 'Post insertado correctamente');
}



    public function delete($id) {
    $post = Post::findOrFail($id);
    
    // Notificar al autor del post si es eliminado por admin
    if (auth()->user()->rol === 'admin' && $post->user_id !== auth()->id()) {
        $postOwner = $post->user;
        $postOwner->notify(new AdminActionNotification(
    $post->title, 
    'Tu post ha sido eliminado por un administrador',
        null // No hay post_id porque el post fue eliminado
));
    }
    
    
    
    $post->delete();

    if (auth()->user()->rol === 'admin') {
        return redirect()->route('admin')
                         ->with('success', 'El post ha sido eliminado correctamente');
    } else {
        return redirect()->route('insert.show', ['id' => auth()->user()->id])
                         ->with('success', 'El post ha sido eliminado correctamente');
    }
}


    public function update(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        'title' => 'required|string|max:255',
        'type'  => 'required|in:Inicio,Tecnología,Experiencia,Opinión',
        'post'  => 'required|string|min:10',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ], [
        'title.required' => 'El título es obligatorio.',
        'title.string'   => 'El título debe ser un texto válido.',
        'title.max'      => 'El título no puede superar los 255 caracteres.',
        'type.required'  => 'El tipo es obligatorio.',
        'post.required'  => 'El contenido del post es obligatorio.',
        'post.min'       => 'El post debe tener mínimo 10 caracteres.',
        'image.image'    => 'El archivo debe ser una imagen.',
        'image.mimes'    => 'La imagen debe ser jpeg, png, jpg, gif o svg.',
        'image.max'      => 'La imagen no puede superar los 2MB.'
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Tomamos el contenido plano del request
    $content = $request->post;

    // Subir imagen nueva si existe y agregar al contenido
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('posts', 'public');
        $imageUrl = asset('storage/' . $imagePath);

        // Insertar marcador de imagen
        $content .= "\n[IMG]{$imageUrl}[/IMG]";
    }

    $post = Post::findOrFail($id);
    $post->title = $request->title;
    $post->type = $request->type;
    $post->post = $content;
    $post->user_id = auth()->id();
    $post->save();

    return redirect()->route('show', ['id' => $post->id])->with('success', 'Post editado correctamente');
}

    public function edit($id)
{
    $post = Post::findOrFail($id);
    return view('post/edit', compact('post'));  
}


    

}
