<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function accesses()
    {
        return $this->hasMany(Access::class);
    }

}
