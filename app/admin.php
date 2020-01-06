<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
    protected $table="admins";
    public function permisions()
    {
        return $this->belongsToMany('App\permision', 'admin_permisions');
    }
    public function admin_permisions()
    {
        return $this->hasMany('App\admin_permision');
    }
}
