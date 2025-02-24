<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name',
        'cost'
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
