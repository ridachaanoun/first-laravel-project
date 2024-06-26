<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title', 'description', 'date', 'location','user_id',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    // Define the relationship using the table name
    public function comments()
    {
        // Assuming you have a "comments" table in your database
        return $this->hasMany('App\Models\Comment', 'event_id');
    }


    public function registrations()
    {
        return $this->hasMany(Registration::class);
        
    }


}


