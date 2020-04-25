<?php
/**
 * controller
 */

header('Content-Type: application/json');
session_start();

require __DIR__."/../../vendor/autoload.php";

$B=new Djang\Base();
$B->ctrl();//check a few things

$Auth=new Djang\Auth($B);

$dat=[];
$dat['POST']=$_POST;

switch($_POST['do']){


    case 'get'://list permissions - auth_permissions
        $sql="SELECT * FROM auth_permission WHERE id>0;";
        $q=$B->db()->query($sql) or die("Error:$sql");

        $dat['list']=[];
        while($r=$q->fetch(PDO::FETCH_ASSOC)){
            $dat['list'][]=$r;
        }

        exit(json_encode($dat));


    case 'getContentTypes':
    case 'contentTypes':
        $dat['types']=$Auth->django_content_types();
        exit(json_encode($dat));


    default:
        $dat['error']='do what?';
        exit(json_encode($dat));

}