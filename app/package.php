<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class package extends Model
{
    public function options()
    {
        return $this->hasMany('App\option');
    }
}
