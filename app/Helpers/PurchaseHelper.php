<?php

namespace App\Helpers;

class PurchaseHelper
{

    public static function count_total($price, $qty)
    {
        $total = 0;
        foreach ($price as $key => $value) {
            $total += $value * $qty[$key];
        }
        return $total;
    }

}
