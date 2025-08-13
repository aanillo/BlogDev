<?php

namespace App\Http\Controllers;


use App\Models\Post;
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
        return view('postsAdminView', compact('posts'));
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
        'type.required'  => 'El tipo es obligatorio.',
        'post.required'  => 'El contenido del post es obligatorio.',
        'post.min' => 'El post debe tener mínimo 10 caracteres.',
        'image.image'    => 'El archivo debe ser una imagen.',
        'image.mimes'    => 'La imagen debe ser jpeg, png, jpg, gif o svg.',
        'image.max'      => 'La imagen no puede superar los 2MB.'
    ]);

    
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    
    $content = $request->post;

    
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('posts', 'public');
        $imageUrl = Storage::url($imagePath);

        
        $content .= "<br><img src='{$imageUrl}' alt='Imagen del post' style='max-width: 100%; height: auto;'>";
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
        $post->delete();
        return redirect() -> route('insert')->with('success', 'El post ha sido eliminado correctamente');
    }


    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'type'  => 'required|in:Inicio,Tecnología,Experiencia,Opinión',
            'post'  => 'required|string|min:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ], [
            'title.required' => 'El título es obligatorio.',
            'type.required'  => 'El tipo es obligatorio.',
            'post.required'  => 'El contenido del post es obligatorio.',
            'image.image'    => 'El archivo debe ser una imagen.',
            'image.mimes'    => 'La imagen debe ser jpeg, png, jpg, gif o svg.',
            'image.max'      => 'La imagen no puede superar los 2MB.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $content = $request->post;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
            $imageUrl = Storage::url($imagePath);

            
            $content .= "<br><img src='{$imageUrl}' alt='Imagen del post' style='max-width: 100%; height: auto;'>";
        }

        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->type = $request->type;
        $post->publish_date = now();
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
