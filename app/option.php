<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class option extends Model
{
    public function package()
    {
        return $this->belongsTo('App\package');
    }
}
