<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Mass Assignment
    protected $guarded = [];

    // Eloquent Relation
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
