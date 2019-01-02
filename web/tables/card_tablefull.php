<?php
/**
 * [$htm description]
 */

$htm='<table class="table table-hover" style="cursor:pointer">';
$htm.='<thead>';
$htm.='<th width=30>#</th>';
$htm.='<th>Name</th>';
$htm.='<th>Date</th>';
$htm.='<th>Text</th>';
$htm.='</thead>';
$htm.='<tbody>';
for ($i=0;$i<6;$i++) {
    $htm.='<tr data-id="">';
    $htm.='<td>'.($i+1);
    $htm.='<td>name';
    $htm.='<td width=100>'.date("Y-m-d");
    $htm.='<td>this is a text and it could be longer';
}
$htm.='</tbody>';
$htm.='</table>';


$card=new LTE\Card;
$card->id('cardTableFull');
$card->title('TableFull');
$card->body($htm);
//$card->small('small text');
$btns='<button class="btn btn-default btn-sm" id=btnSave disabled><i class="fa fa-save"></i> Save</button>';
//$card->footer($btns);
//$card->collapsable(true);
//$card->loading(1);
$card->p0(1);
//$card->class('p-0');
echo $card;