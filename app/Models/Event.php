<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'event_date',
        'location',
        'max_participants'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function participants_count()
    {
        return $this->users()->count();
    }

    
}