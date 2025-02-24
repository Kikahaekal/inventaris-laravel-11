<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guard = [
        'id'
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function categories()
    {
        $this->belongsToMany(Category::class);
    }
}
