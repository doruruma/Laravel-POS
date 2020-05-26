<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Mass Assignment
    protected $guarded = [];

    // Eloquent Relation
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
