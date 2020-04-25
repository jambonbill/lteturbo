<?php
/**
 * Box groups
 */
$htm='please wait';

$box=new LTE\Card;
$box->id('boxGroups');
//$box->icon('fa fa-list');
$box->title('Groups');
//$box->tools('<input type=text class="form-control form-control-sm" placeholder="Search" id=search autocomplete=off>');
$box->body($htm);
//$box->small('small text');
$btns='<button class="btn btn-primary btn-sm" id=btnNew><i class="fas fa-plus-circle"></i> New group</button>';
$box->footer($btns);
//$box->collapsable(true);
$box->p0(1);
$box->loading(1);
echo $box;