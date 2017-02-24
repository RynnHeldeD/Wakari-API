<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    protected $table = 'words';

    public function themes()
    {
        return $this->belongsToMany('App\Theme');
    }
}
