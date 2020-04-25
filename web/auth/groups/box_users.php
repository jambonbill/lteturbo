<?php
/**
 * Box group
 */
$htm='please wait';

$box=new LTE\Card;
$box->id('boxUsers');
//$box->icon('fa fa-list');
$box->title('Group user(s)');
$box->tools('<input type=text class="form-control form-control-sm" placeholder="Search" id=searchGroup autocomplete=off>');
$box->body($htm);

//$box->small('small text');
$btns='<a href=# class="btn btn-default btn-sm" id=btnEdit><i class="fas fa-edit"></i> Edit group</a>';
$box->footer($btns);
//$box->collapsable(true);
$box->p0(1);
$box->loading(1);
echo $box;