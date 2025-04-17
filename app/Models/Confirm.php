<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Confirm extends Model
{
    use HasFactory;
    protected $guarded = [];



    function users()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    function locations()
    {
        return $this->hasOne('App\Models\Location', 'id', 'location_id');
    }
}
