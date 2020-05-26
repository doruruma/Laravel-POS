<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Access;

class AccessController extends Controller
{
    
    public function get($access)
    {
        return response()->json(Access::where('role_id', $access));
    }

}
