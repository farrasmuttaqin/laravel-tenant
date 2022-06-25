<?php

if (!function_exists('random5chars')) {
    /**
     * random 5 chars function
     *
     * @return false|string
     */
    function random5chars()
    {
        $length = 5;

        return substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, $length);
    }
}

