<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class permision extends Model
{
    protected $table = "permisions";
    public function admins()
    {
        return $this->belongsToMany('App\admin', 'admin_permisions');
    }
}
