<?php

use App\Models\Usersweb;

if (!function_exists('getUserswebProvidersArray')) {
    function getUserswebProvidersArray() {
        return [
            "passolutionweb" => "web.passolution.de",
            "myjack" => "Bewotec",
            "midoco" => "Midoco",
            "bosys" => ".BOSYS",
            "traso" => "TraSo",
            "ziel" => "Ziel",
            "schmetterling" => "Schmetterling",
            "api" => "API",
        ];
    }
}

if (!function_exists('convertUserswebProviderCode2Text')) {
    function convertUserswebProviderCode2Text($code) {
        $providersArr = getUserswebProvidersArray();
        if (array_key_exists($code, $providersArr)) {
            return $providersArr[$code];
        } else {
            return '';
        }
    }
}
