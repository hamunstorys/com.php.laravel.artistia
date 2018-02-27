<?php

namespace App\Helpers;


class Helper
{
    public function __construct()
    {

    }

    public function NumberNullCheck($data)
    {
        if ($data == null) {
            return '0';
        } else {
            return number_format($data);
        }
    }
}