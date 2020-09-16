<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{

    // Mass Assignment
    protected $guarded = [];

    // Eloquent Relation
    public function detail()
    {
        return $this->hasMany(Purchase_detail::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    
}
