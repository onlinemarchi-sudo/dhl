<?php

function get_user_ip()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP)) {
        $ip = $client;
    } else if(filter_var($forward, FILTER_VALIDATE_IP)) {
        $ip = $forward;
    } else {
        $ip = $remote;
    }

    return $ip;
}

function get_user_country()
{
    $ip = get_user_ip();
    $details = json_decode(@file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));

    if ($details && $details->geoplugin_countryName != null) {
        $countryname = $details->geoplugin_countryName;
        return $countryname;
    }

    return "Unknown";
}

$get_user_country = get_user_country();

