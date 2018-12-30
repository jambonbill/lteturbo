<?php
header('Content-Type: text/html; charset=utf-8');
session_start();

require __DIR__ . "/../../vendor/autoload.php";

//exit("hi");
//print_r($_POST);
// Login logic//

$B=new CRM\Base;
$UD=new Django\UserDjango($B->db());

if($UD->login($_POST['email'], $_POST['password'])){
    //echo "ok";
    //echo '<script>document.location.href="../home";</script>';
    header('location:../home');
    exit;
}else{
    echo "nope";
    echo '<script>document.location.href="index.php";</script>';
}
