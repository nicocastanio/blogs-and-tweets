<?php

namespace App\Http\Controllers;

use App\Entry;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    //
    public function index() {
        // dd('GuestController');

        // $entries = Entry::all();
        // $entries = Entry::paginate(10);

        //buscar tambien los nombres de los Usuarios . pasarle a 'with' el nombre del método en el modelo Entry que devuelve los usuarios.
        $entries = Entry::with('user')
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->paginate(10);

        return view('welcome', compact('entries'));
    }


    public function show(Entry $entry) {
        return view('entries.show', compact('entry'));
    }

}
