<?php

namespace App\Policies;

use App\User;
use App\Entry;
use Illuminate\Auth\Access\HandlesAuthorization;

class EntryPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    // devuelve boolean
    public function update(User $user, Entry $entry)
    {
        return $user->id === $entry->user_id;
        // True : si el usuario es el creador de la Entrada
    }

}
