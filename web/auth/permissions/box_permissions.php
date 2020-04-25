<?php
/**
 * Box perms
 */
$htm='please wait';

$box=new LTE\Card;
$box->id('boxPerms');
//$box->icon('fa fa-list');
$box->title('Permissions');
$box->tools('<input type=text class="form-control form-control-sm" placeholder="Search" id=search autocomplete=off>');
$box->body($htm);

//$box->small('small text');
$btns='<button class="btn btn-default btn-sm" id=btnNew><i class="fa fa-save"></i> New permission</button>';
$box->footer($btns);
//$box->collapsable(true);
$box->p0(1);
$box->loading(1);
echo $box;

//User->hasPerm("permission.action");