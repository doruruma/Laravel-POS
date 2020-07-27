<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{

    // Mass Assignment
    protected $guarded = [];

    // Eloquent Relation
    public function Purchases()
    {
        return $this->hasMany(Purchase::class);
    }

}
