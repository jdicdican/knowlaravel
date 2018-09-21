<?php

namespace App\Services\Security;

trait TokenDependent {
    public function generateToken($string = "")
    {
        return hash('sha256', $string.date("D M d, Y G:i"));
    }
}