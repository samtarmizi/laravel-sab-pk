<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    // define fillables for mass assignments
    protected $fillable = [
        'title', 'description', 'user_id', 'attachment'
    ];

    // one training belongs to one user
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    //getter - return attachment url $training->attachment_url
    public function getAttachmentUrlAttribute()
    {
        return asset('storage/'.$this->attachment);
    }
}
