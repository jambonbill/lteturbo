<?php
/**
 * Box group
 */
$htm='please wait';

$box=new LTE\Card;
$box->id('boxGroup');
//$box->icon('fa fa-list');
$box->title('Group user(s)');
$box->tools('<input type=text class="form-control form-control-sm" placeholder="Search" id=searchGroup autocomplete=off>');
$box->body($htm);

//$box->small('small text');
$btns='<button class="btn btn-default btn-sm" id=btnNew><i class="fas fa-plus-circle"></i> Add user(s)</button>';
$box->footer($btns);
//$box->collapsable(true);
$box->p0(1);
$box->loading(1);
echo $box;