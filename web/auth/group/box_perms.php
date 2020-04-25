<?php
/**
 * Box perms
 */
$htm='please wait';

$box=new LTE\Card;
$box->id('boxPerms');
$box->icon('fas fa-key');
$box->title('Group permission(s)');
//$box->tools('<input type=text class="form-control form-control-sm" placeholder="Search" id=search autocomplete=off>');
$box->body($htm);

//$box->small('small text');
$btns='<button class="btn btn-default btn-sm" id=btnPopPerms><i class="fas fa-plus-circle"></i> Add permission</button>';
$btns.='<button class="btn btn-default btn-sm float-right" id=btnDelPerm disabled><i class="fas fa-times"></i> Remove</button>';
$box->footer($btns);
//$box->collapsable(true);
$box->p0(1);
$box->loading(1);
echo $box;

//$permlist=$A->permissions();
//echo '<pre>';print_r($permlist);echo '</pre>';
