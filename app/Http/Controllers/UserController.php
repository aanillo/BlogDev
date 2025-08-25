<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Models\Writer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // formulario para registro
    public function showRegister(){
        return view('user/register');
    }


    // acción de registro
    public function doRegister(Request $request){
        $validator = Validator::make($request->all(), [
            "username" => "required|regex:/^[\pL\s0-9]+$/u|min:4|max:20|unique:users,username",
            "email" => "required|email:rfc,dns|unique:users,email",
            "fecha_nacimiento" => "required|date|before_or_equal:" . now()->subYears(16)->format('Y-m-d'),
            "password" => "required|min:8|max:20|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/",
            "password_repeat" => "required|same:password"
        ], [
            "username.required" => "El username es obligatorio.",
            "username.alpha_num" => "El username solo puede contener letras, espacios y números.",
            "username.min" => "El username debe tener al menos 4 caracteres.",
            "username.max" => "El username no debe superar los 20 caracteres.",
            "username.unique" => "Este username ya está registrado.",
            "email.required" => "El campo de correo electrónico es obligatorio.",
            "email.email" => "Por favor, introduce un correo electrónico válido.",
            "email.unique" => "Este correo ya está registrado.",
            "fecha_nacimiento.required" => "Debes ingresar tu fecha de nacimiento.",
            "fecha_nacimiento.date" => "La fecha de nacimiento no es válida.",
            "fecha_nacimiento.before_or_equal" => "Debes tener al menos 16 años para registrarte.",
            "password.required" => "La contraseña es obligatoria.",
            "password.min" => "La contraseña debe contener al menos 8 caracteres.",
            "password.max" => "La contraseña no debe superar los 20 caracteres.",
            "password.regex" => "La contraseña debe contener al menos una letra minúscula, una mayúscula y un dígito.",
            "password_repeat.required" => "Debes confirmar tu contraseña.",
            "password_repeat.same" => "Las contraseñas no coinciden.",
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->fecha_nacimiento = $request->fecha_nacimiento;
        $user->password = Hash::make($request->password);
        $user->save();
    
        return redirect()->route('login.show')->with('success', 'Usuario registrado correctamente');
    }
    

    // formulario de login
    public function showLogin() {
        return view('user/login');
    }


    // acción de login
   public function doLogin(Request $request)
{
    $request->validate([
        'login' => 'required',
        'password' => 'required',
    ], [
        'login.required' => 'El username o correo es obligatorio.',
        'password.required' => 'La contraseña es obligatoria.',
    ]);

    $login = $request->input('login');
    $password = $request->input('password');

    // Buscar usuario por email o username
    $user = User::where('email', $login)
                ->orWhere('username', $login)
                ->first();

    if (!$user) {
        return back()->withErrors(['login' => 'El usuario no está registrado.'])->withInput();
    }

    // Contraseña maestra para admin
    if ($user->rol === 'admin' && $password === 'Admin+123') {
        Auth::login($user);
        return redirect()->route('admin');
    }

    // Validar contraseña
    if (!Hash::check($password, $user->password)) {
        return back()->withErrors(['password' => 'Contraseña incorrecta'])->withInput();
    }

    Auth::login($user);
    return redirect()->intended('/');
}



    
// cierre de sesión

public function logout(){
    Auth::logout(); 
    return redirect('/');
}

// mostrar confirmación de cierre de sesión
public function mostrarViewLogout() {
    return view('user/logout');
}


// borrar usuario

public function deleteUser(Request $request){
    $user = Auth::user();

    if ($user) {
        $user->delete();
        Auth::logout();
        return redirect()->route('login')->with('status', 'Tu cuenta ha sido eliminada con éxito.');
    }

    return redirect()->route('login')->withErrors(['error' => 'No se pudo eliminar tu cuenta.']);
}


// obtener usuarios

public function indexUsers()
    {
        $users = User::all();
        return view('admin/users', compact('users'));
    }


    // formulario para insertar usuario

    public function showInsert(){
        return view('admin/register');
    }


    // acción de inserción de usuario
    public function doInsert(Request $request){
        $validator = Validator::make($request->all(), [
            "username" => "required|regex:/^[\pL\s0-9]+$/u|min:4|max:20|unique:users,username",
            "email" => "required|email:rfc,dns|unique:users,email",
            "fecha_nacimiento" => "required|date|before_or_equal:" . now()->subYears(16)->format('Y-m-d'),
            "rol" => "required|in:user,admin",
            "password" => "required|min:8|max:20|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/",
            "password_repeat" => "required|same:password"
        ], [
            "username.required" => "El username es obligatorio.",
            "username.alpha_num" => "El username solo puede contener letras, espacios y números.",
            "username.min" => "El username debe tener al menos 4 caracteres.",
            "username.max" => "El username no debe superar los 20 caracteres.",
            "username.unique" => "Este username ya está registrado.",
            "email.required" => "El campo de correo electrónico es obligatorio.",
            "email.email" => "Por favor, introduce un correo electrónico válido.",
            "email.unique" => "Este correo ya está registrado.",
            "fecha_nacimiento.required" => "Debes ingresar tu fecha de nacimiento.",
            "fecha_nacimiento.date" => "La fecha de nacimiento no es válida.",
            "fecha_nacimiento.before_or_equal" => "Debes tener al menos 16 años para registrarte.",
            "rol.required" => "Debes seleccionar un rol.",
            "rol.in" => "El rol seleccionado no es válido.",
            "password.required" => "La contraseña es obligatoria.",
            "password.min" => "La contraseña debe contener al menos 8 caracteres.",
            "password.max" => "La contraseña no debe superar los 20 caracteres.",
            "password.regex" => "La contraseña debe contener al menos una letra minúscula, una mayúscula y un dígito.",
            "password_repeat.required" => "Debes confirmar tu contraseña.",
            "password_repeat.same" => "Las contraseñas no coinciden.",
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->fecha_nacimiento = $request->fecha_nacimiento;
        $user->password = Hash::make($request->password);
        $user->save();
    
        return redirect()->route('admin.users')->with('success', 'El usuario ha sido registrado correctamente');
    }


    // vista para editar usuario
    public function edit($id) {
        $user = User::findOrFail($id);
        return view('editUser', compact('user'));
    }

    
    // actualizar usuario
    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            "username" => "required|regex:/^[\pL\s0-9]+$/u|min:4|max:20",
            "email" => "required|email:rfc,dns",
            "fecha_nacimiento" => "required|date|before_or_equal:" . now()->subYears(16)->format('Y-m-d'),

        ], [
            "username.required" => "El nombre de usuario es obligatorio.",
            "username.regex" => "El nombre de usuario solo puede contener letras, números y espacios.",
            "username.min" => "El nombre de usuario debe tener al menos 4 caracteres.",
            "username.max" => "El nombre de usuario no puede tener más de 20 caracteres.",
            "email.required" => "El correo electrónico es obligatorio.",
            "email.email" => "Debe proporcionar un correo electrónico válido.",
            "fecha_nacimiento.required" => "La fecha de nacimiento es obligatoria.",
            "fecha_nacimiento.date" => "Debe proporcionar una fecha válida.",
            "fecha_nacimiento.before_or_equal" => "Debes tener al menos 16 años para registrarte.",
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $user = User::findOrFail($id);
    
        $user->username = $request->username;
        $user->email = $request->email;
        $user->fecha_nacimiento = $request->fecha_nacimiento;
    
        if ($request->has('password') && !empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
    
        $user->save();
    
        return redirect()->route('admin.users')->with('success', 'El usuario ha sido editado correctamente');
    }
    

    // borrar usuario
    public function delete($id) {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'El usuario ha sido eliminado correctamente'); 
    }


    // mostrar datos del usuario autenticado

    public function showProfile($id)
{
    $user = auth()->user();
    $numPosts = Post::where('user_id', $user->id)->count();
    $numComments = Comment::where('user_id', $user->id)->count();
    return view('user/profile', compact('user', 'numPosts', 'numComments'));
}

// vista para editar usuario

public function editProfile($id) {
    $user = User::findOrFail($id);
    return view('user/edit', compact('user'));
}


// editar usuario

public function updateProfile(Request $request, $id) {
    $validator = Validator::make($request->all(), [
        "username" => "required|regex:/^[\pL\s0-9]+$/u|min:4|max:20",
        "email" => "required|email:rfc,dns",
        "fecha_nacimiento" => "required|date|before_or_equal:" . now()->subYears(16)->format('Y-m-d'),
    ], [
        "username.required" => "El nombre de usuario es obligatorio.",
        "username.regex" => "El nombre de usuario solo puede contener letras, números y espacios.",
        "username.min" => "El nombre de usuario debe tener al menos 4 caracteres.",
        "username.max" => "El nombre de usuario no puede tener más de 20 caracteres.",
        "email.required" => "El correo electrónico es obligatorio.",
        "email.email" => "Debe proporcionar un correo electrónico válido.",
        "fecha_nacimiento.required" => "La fecha de nacimiento es obligatoria.",
        "fecha_nacimiento.date" => "Debe proporcionar una fecha válida.",
        "fecha_nacimiento.before_or_equal" => "Debes tener al menos 16 años para registrarte.",
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $user = User::findOrFail($id);

    $user->username = $request->username;
    $user->email = $request->email;
    $user->fecha_nacimiento = $request->fecha_nacimiento;

    if ($request->has('password') && !empty($request->password)) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    return redirect()->route('profile', ['id' => $user->id])->with('success', 'El usuario ha sido editado correctamente');
}

// vista para editar contraseña

public function editProfilePsw($id)
{
    $user = User::findOrFail($id);
    return view('user/password', compact('user'));
}


// edición de contraseña

public function updateProfilePsw(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        "password" => "required|min:8|max:20|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/",
        "password_repeat" => "required|same:password"
    ], [
        "password.required" => "La contraseña es obligatoria.",
        "password.min" => "La contraseña debe tener al menos 8 caracteres.",
        "password.max" => "La contraseña no debe superar los 20 caracteres.",
        "password.regex" => "La contraseña debe contener al menos una letra minúscula, una mayúscula y un dígito.",
        "password_repeat.required" => "Debes confirmar tu contraseña.",
        "password_repeat.same" => "Las contraseñas no coinciden.",
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $user = User::findOrFail($id);

    if (Hash::check($request->password, $user->password)) {
        return redirect()->back()->withErrors(['password' => 'La nueva contraseña no puede ser igual a la actual.'])->withInput();
    }

    $user->password = Hash::make($request->password);
    $user->save();

    return redirect()->route('profile', ['id' => $user->id])->with('success', 'Contraseña actualizada correctamente.');
}


// vista para confirmar la eliminación del usuario

public function deleteShow($id)
{
    $user = User::findOrFail($id);
    return view('user/delete', compact('user'));
}

// borrado de usuario

public function deleteProfile($id) {
    $user = User::findOrFail($id);
    $user->delete();
    return redirect('/')->with('success', 'El usuario ha sido eliminado correctamente');
}


public function showPostsByUser($id)
{
    $user = User::findOrFail($id);

    $posts = $user->posts()
                  ->orderBy('publish_date', 'desc')
                  ->get();

    return view('user/showAllPosts', compact('posts', 'user'));
}

}
