<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    
    public static function active()
    {
        return static::whereActive(true)->get();
    }
}
