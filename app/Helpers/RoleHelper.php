<?php

namespace App\Helpers;

use App\Access;

class RoleHelper
{

    public static function check($role_id, $menu_id)
    {
        if (Access::where(['role_id' => $role_id, 'menu_id' => $menu_id])->exists()) {
            return "checked='checked'";
        }
    }

}
