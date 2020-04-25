<?php
/**
 * controller
 */

header('Content-Type: application/json');
session_start();

require __DIR__."/../../../vendor/autoload.php";

$B=new Djang\Base();
$B->ctrl();//check a few things

$A=new Djang\Auth($B);

$dat=[];
$dat['POST']=$_POST;

switch($_POST['do']){


    case 'get':
        $dat['groups']=$A->groups();
        exit(json_encode($dat));


    case 'groupUsers':
        $gusers=$A->groupUsers($_POST['group_id']);
        $users=[];
        foreach($gusers as $uid){
            $users[]=$B->authUser($uid);
        }
        $dat['users']=$users;
        exit(json_encode($dat));


    case 'groupUserAdd':
        $dat['created']=$A->groupUserAdd($_POST['group_id'], $_POST['user_id']);
        exit(json_encode($dat));


    case 'create':
    	//print_r($_POST);
    	$dat['created']=$A->groupCreate($_POST['name']);
		exit(json_encode($dat));


    default:
        $dat['error']='do what?';
        exit(json_encode($dat));

}