<?php
/**
 * Box users
 */

$htm='please wait';

$box=new LTE\Card;
$box->id('boxUsers');
$box->icon('fas fa-users');
$box->title('Users');
$box->small('<a href="../auth_users/"><i class="fas fa-angle-double-right"></i></a>');
//$box->tools('<input type=text class="form-control form-control-sm" placeholder="Search" id=search autocomplete=off>');
$box->body($htm);
//$box->small('small text');
$btns='<button class="btn btn-default btn-sm" id=btnAddUser><i class="fas fa-plus-circle"></i> Add user</button>';
$btns.='<button class="btn btn-default btn-sm float-right" id=btnDelUser disabled><i class="fas fa-times"></i> Remove</button>';
$box->footer($btns);
//$box->collapsable(true);
$box->p0(1);
$box->loading(1);
echo $box;