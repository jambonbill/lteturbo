<?php
/**
 * Card calendar
 */

$htm='<div id=calendar>calendar</div>';

$card=new LTE\Card;
$card->id('cardCalendar');
//$card->title('Calendar');
$card->body($htm);
//$card->small('small text');
$btns='<button class="btn btn-default btn-sm" id=btnSave disabled><i class="fa fa-save"></i> Save</button>';
//$card->footer($btns);
//$card->collapsable(true);
$card->loading(1);
echo $card;