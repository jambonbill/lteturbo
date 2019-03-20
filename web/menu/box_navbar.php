<?php
/**
 * Box navbar
 */


$htm='please wait';
$htm='<pre>'.print_r($admin->config()->navbar,1).'</pre>';

$card=new LTE\Card;
$card->id('boxNavbar');
$card->title('Navbar');
$card->body($htm);
//$card->small('small text');
//$btns='<button class="btn btn-default btn-sm" id=btnSave disabled><i class="fa fa-save"></i> Save</button>';
//$card->footer($btns);
//$card->collapsable(true);
$card->loading(1);
echo $card;