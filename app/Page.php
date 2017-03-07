<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'pages';
    public $timestamps = false;

    public function themes()
    {
        return $this->belongsToMany('App\Theme');
    }

    public function pagesLinkedTo()
    {
        return $this->belongsToMany('App\Page', 'page_page', 'page_to_id', 'page_from_id');
    }

    public function pagesLinkedFrom()
    {
        return $this->belongsToMany('App\Page', 'page_page', 'page_from_id', 'page_to_id');
    }
}
