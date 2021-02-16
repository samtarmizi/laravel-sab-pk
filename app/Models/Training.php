<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    // one training belongs to one user
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
