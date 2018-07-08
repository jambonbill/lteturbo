<?php
header('Content-Type: text/html; charset=utf-8');
session_start();

require __DIR__ . "/../../vendor/autoload.php";

$admin = new LTE\Admin;
$admin->title("Login");
$admin->config()->menu = (object)[];//unset the global menu
$admin->config()->layout->{'sidebar-collapse'}=true;
echo $admin->head();

$Djang=new Django\Djang;
$Djang->logout();
?>
<pre>your logout script here</pre>
