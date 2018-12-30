<?php
/**
 * Box tickets
 */


$box=new LTE\Card;
$box->id('boxTickets');
$box->title('Tickets');
$box->body('please wait');
//$box->small('small text');
$box->footer('<button class="btn btn-default btn-sm" id=btnSave disabled><i class="fa fa-save"></i> Save</button>');
//$box->collapsable(true);
$box->loading(1);
echo $box;