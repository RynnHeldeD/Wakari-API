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

    public function getThemes() {
        $themes = [];

        foreach ($this->themes as $theme) {
            $themes[] = $theme;
        }

        return $this->themes;
    }
}
