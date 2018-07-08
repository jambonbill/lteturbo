<?php
header('Content-Type: text/html; charset=utf-8');
session_start();

require __DIR__ . "/../../vendor/autoload.php";

print_r($_POST);
// Login logic//

//1st, db creds, connection
//3 : db check
//4 : db register
//5 redirect