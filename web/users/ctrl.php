<?php
header('Content-Type: application/json');
session_start();

require __DIR__."/../../vendor/autoload.php";

//$J=new JAMBON\Jambon();
$USER=null;
//$Ctrl=new JAMBON\Ctrl($J);
//print_r($USER->users());exit;

$dat=[];
$dat['POST']=$_POST;

switch($_POST['do'])
{

    case 'getUsers':
        $dat['users']=[];
        exit(json_encode($dat));


	case 'userCreate':

        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
          $dat['user_id']=$USER->userCreate($_POST['email']);
        } else {
          $dat['error']="not a valid email address";
        }

        exit(json_encode($dat));

    default:
        $dat['error']='do what?';
        exit(json_encode($dat));
}

