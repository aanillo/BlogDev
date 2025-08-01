<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Writer;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // página principal
    public function index() {
        return view('home');
    }
    

    // página principal usuario logueado
    public function indexLog()
{
    $user = auth()->user();
    $randomBooks = Book::all()->shuffle()->take(7);
    $randomWriters = Writer::all()->shuffle()->take(16);
    return view('homeLog', compact('user', 'randomBooks', 'randomWriters'));
}


// página principal de admin

public function indexAdmin()
{
    $user = auth()->user();

    if (!$user || $user->rol !== 'admin') {
        abort(403, 'No tienes permiso para acceder a esta página.');
    }

    return view('adminHome', compact('user'));
}

}
