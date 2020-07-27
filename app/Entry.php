<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Entry extends Model
{
    // armamos la relacion entre Entry y User.  $entry->user
    // Entry N - 1 User
    // Eager loading
    public function user() {
        return $this->belongsTo(User::class);
    }

    // mutator
    public function setTitleAttribute($value) {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }

    public function getUrl()
    {
        return url("entries/$this->slug-$this->id");  // con comillas dobles no necesitamos '.' para concatenar
        // return url('entries/'.$this->slug.'-'.$this->id);
    }
}
