<?php

header('Content-Type: text/html; charset=utf-8');
session_start();

require __DIR__."/../vendor/autoload.php";

$admin = new LTE\Admin;
$admin->title("VJ");
echo $admin;
