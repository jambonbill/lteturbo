<?php
header('Content-Type: application/json');
session_start();

require __DIR__."/../../vendor/autoload.php";

$J=new JAMBON\Jambon();

switch($_POST['do'])
{

	case 'newUser':

		if ($user_id=$edxapp->userExist($_POST['email'])) {
            echo "alert('This user already exist !');\n";
            die("document.location.href='../user/?id=$user_id';\n");
        }

        $user_id=$edxapp->userCreate($_POST['email']);

        if ($user_id) {
            die("document.location.href='../user/?id=$user_id';\n");
        } else {
            die("alert('error creating user');");
        }

		exit;

    case 'deleteUser':
        //print_r($_POST);
        if($J->userDelete($_POST['user_id'])){
            die("document.location.href='../users/';");
        }
        die("Error deleting user #".$_POST['user_id']);
        exit;

    case 'changePassword':
        //print_r($_POST);
        if(strlen($_POST['password'])<3) {
            die('alert("Error : Password is too short !");');
        }

        $password=$J->UD()->djangopassword($_POST['password']);

        if ($password) {
            $J->updatePassword($_POST['user_id'], $password);
            die("document.location.href='?id=".$_POST['user_id']."'");
        }
        die("Error");
        exit;

    default:
        print_r($_POST);
        exit;

}

die("Error");