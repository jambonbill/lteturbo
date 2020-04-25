<?php
/**
 * controller
 */

header('Content-Type: application/json');
session_start();

require __DIR__."/../../../vendor/autoload.php";

$B=new Djang\Base();
$B->ctrl();//check a few things


$dat=[];
$dat['POST']=$_POST;

switch($_POST['do']){

case 'get':

    $LIMIT=300;

    $WHERE=[];
    $WHERE[]='1=1';

    if ($_POST['search']) {
        $WHERE[]='message LIKE '.$B->db()->quote('%'.$_POST['search'].'%');
    }

    if($_POST['userid']>0){
        $WHERE[]='userid='.$B->db()->quote($_POST['userid']);
    }

    if($_POST['channel']){
        $WHERE[]='channel LIKE '.$B->db()->quote($_POST['channel']);
    }

    if ($_POST['date']) {
        //$WHERE[]='time > x AND time < x;
    }

    if ($_POST['limit']>0) {
        $LIMIT=$_POST['limit']*1;
    }



    $sql="SELECT * FROM djang_log WHERE ".implode(" AND ", $WHERE)." ORDER BY time DESC LIMIT $LIMIT;";
    $q=$B->db()->query($sql) or die($B->db()->errorInfo()[2]."\n$sql");

    $logs=[];
    while($r=$q->fetch(PDO::FETCH_ASSOC)){
    	$logs[]=$r;
    }

    $dat['logs']=$logs;

    exit(json_encode($dat));

default:
    $dat['error']='do what?';
    exit(json_encode($dat));

}