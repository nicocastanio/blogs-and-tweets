<?php

namespace App\Http\Controllers;

use App\Entry;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function show(User $user = null)
    {
        // obtener Entries del usuario
        $entries = Entry::where('user_id',$user->id)->get();
        // otra forma sería armar una relacion en el Modelo del usuario y traerlas desde ahi

        return view('users.show', compact('user', 'entries'));
    }
}
