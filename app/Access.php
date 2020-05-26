<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    
    protected $guarded = [];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

}
