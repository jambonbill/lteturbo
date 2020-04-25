<?php
//box

$box=new LTE\Card;
$box->id('boxLogs');
$box->title('Logs');
$box->body('please wait');
//$box->small('small text');
$box->p0(true);
$box->loading(1);
echo $box;