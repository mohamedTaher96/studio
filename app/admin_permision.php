<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class admin_permision extends Model
{
    protected $teble = "admin_permisions";
    public function admins()
    {
        return $this->belongsToMany('App\admin');
    }
}
