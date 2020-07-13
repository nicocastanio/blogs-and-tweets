<?php

namespace App\Http\Controllers;

use App\Entry;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // con esto protegemos todos los metodos del controlador para que solo accedan usuarios logeados.
    }

    // muestro formulario
    public function create()
    {
        return view('entries.create');
    }

    // grabo en DB
    public function store(Request $request)
    {
    //    dd($request->all());
        $validatedData = $request->validate([
            'title' => 'required|min:7|max:255|unique:entries',
            'content' => 'required|min:25|max:3000'
        ]);

        $entry = new Entry();
        $entry->title = $validatedData['title'];
        $entry->content = $validatedData['content'];
        $entry->user_id = auth()->id();
        $entry->save(); // INSERT en DB

        // podemos mantener al user en la misma pagina o dirigirlo a crear otra
        $status = 'Tu entrada ha sido publicada correctamente';
        return back()->with(compact('status'));

    }

    public function edit(Entry $entry)
    {
        $this->authorize('update', $entry);
        // // alternativa al uso de policies es manejarlo por código:
        // if (auth()->id() !== $entry->user_id) {
        //     return redirect('/');
        // }

        return view('entries.edit', compact('entry'));
    }

    // grabo en DB
    public function update(Request $request, Entry $entry)
    {
        $this->authorize('update', $entry);
        // // alternativa al uso de policies es manejarlo por código:
        // if (auth()->id() !== $entry->user_id) {
        //     return redirect('/');
        // }

    //    dd($request->all());
        $validatedData = $request->validate([
            'title' => 'required|min:7|max:255|unique:entries,id,'.$entry->id,  // agregamos id para que no verifique contra sí
            'content' => 'required|min:25|max:3000'
        ]);

            //  TODO: permitir editar solo al autor
        // $entry = new Entry();
        $entry->title = $validatedData['title'];
        $entry->content = $validatedData['content'];
        // $entry->user_id = auth()->id();
        $entry->save(); // UPDATE en DB

        // podemos mantener al user en la misma pagina o dirigirlo a crear otra
        $status = 'Tu entrada ha sido actualizada correctamente';
        return back()->with(compact('status'));

    }


}
