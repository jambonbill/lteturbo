<?php
//controller
//header('Content-Type: text/html; charset=utf-8');
session_start();

require __DIR__."/../../vendor/autoload.php";

$Ctrl=new CRM\Ctrl();

$dat=[];
$dat['POST']=$_POST;

switch($_POST['do']){
	
	default:
		exit(json_encode($dat));
}