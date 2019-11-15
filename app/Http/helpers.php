<?php

use Carbon\Carbon;

if (! function_exists('helloWorld')) {
    function helloWorld()
    {
        return "Hello World!!!";
    }
}

/**
 * Generate a new token for api authentication
 * 
 * @return string
 */
if (! function_exists('generateToken')) {
    function generateToken()
    {
        $randomStr = Str::random(80);
        $token     = hash('sha256', $randomStr) ;

        return $token;
    }
}

/**
 * Generate a expiration date for a token
 * 
 * @return string
 */
if (! function_exists('generateTokenExpiry')) {
    function generateTokenExpiry()
    {
        $now    = now();
        $expiry = $now->addDays(3)->toDateTimeString();

        return $expiry;
    }
}

/**
 * Check if token is valid
 * 
 * @return boolean
 */
if (! function_exists('checkTokenExpiry')) {
    function checkTokenExpiry($exp)
    {
        $now    = now();
        $expiry = Carbon::parse($exp);
        $checkExpiry = $now->lessThan($expiry);
        
        return $checkExpiry;
    }
}