<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name'
    ];

    public function items() 
    {
        $this->belongsToMany(Item::class);
    }

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
