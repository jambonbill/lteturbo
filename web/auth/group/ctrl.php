<?php
/**
 * controller
 */

header('Content-Type: application/json');
session_start();

require __DIR__."/../../vendor/autoload.php";

$B=new Djang\Base();
$B->ctrl();//check a few things

$A=new Djang\Auth($B);

$dat=[];
$dat['POST']=$_POST;

switch($_POST['do']){

    case 'getPerms':
    case 'perms':
        $perms=$A->groupPermissions($_POST['id']);
        foreach($perms as $k=>$v){
            $p=$A->permission($v['permission_id']);
            $perms[$k]['name']=$p['name'];
            $perms[$k]['content_type_id']=$p['content_type_id'];
        }
        $dat['perms']=$perms;
        exit(json_encode($dat));


    case 'addPerm':
        $dat['created']=$A->groupPermissionAdd($_POST['group_id'], $_POST['perm_id']);
        exit(json_encode($dat));


    case 'deletePerm':
        $dat['deleted']=$A->groupPermissionDelete($_POST['id']);
        exit(json_encode($dat));


    case 'listPermissions'://list of all perms
        $dat['list']=$A->permissions();
        exit(json_encode($dat));


    case 'getUsers':
    case 'users':
        $gusers=$A->groupUsers($_POST['id']);
        $users=[];
        foreach($gusers as $uid){
            $usr=$B->authUser($uid);
            $users[]=$usr;
        }
        $dat['users']=$users;
        exit(json_encode($dat));


    case 'groupUserAdd':
        if($user_id=$A->exist($_POST['email'])){
            $dat['created']=$A->groupUserAdd($_POST['group_id'], $user_id);
        }else{
            $dat['error']='User not found';
        }
        exit(json_encode($dat));


    case 'groupUserDel':
    case 'groupUserDelete':
        $dat['created']=groupUserDelete($_POST['id']);
        exit(json_encode($dat));


    default:
        $dat['error']='do what?';
        exit(json_encode($dat));

}