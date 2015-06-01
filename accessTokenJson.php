<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Maarten
 * Date: 9-4-2015
 * Time: 16:24
 */


$accesstoken = $_COOKIE["access_token"];
$result = array($accesstoken);
$resultEncode = json_encode($result);

print_r($resultEncode);