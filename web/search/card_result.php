<?php

$htm='no result';

$box=new LTE\Card;
$box->id('boxResult');
//$box->title('Search');
$box->body($htm);
//$box->small('small text');
//$btns='<button class="btn btn-default btn-sm" id=btnSave disabled><i class="fa fa-save"></i> Save</button>';
//$box->footer($btns);
//$box->collapsable(true);
$box->loading(0);
echo $box;