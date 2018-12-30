<?php
/**
 * Modal ticket
 * @var LTE
 */


$htm='<div class="row">';

$htm.='<div class="col-12">';
$htm.='<div class="form-group">';
$htm.='<label>Subject</label>';
$htm.='<input type="text" class="form-control" placeholder="Placeholder">';
$htm.='</div>';
$htm.='</div>';

$htm.='<div class="col-12">';
$htm.='<div class="form-group">';
$htm.='<label>Subject</label>';
$htm.='<input type="text" class="form-control" placeholder="Placeholder">';
$htm.='</div>';
$htm.='</div>';

$htm.='</div>';


$modal=new LTE\Modal;
$modal->id('modalTicket');
$modal->title('New ticket');
$modal->body($htm);
$btns='<button id=btnSave class="btn btn-default btn-sm"><i class="fa fa-save"></i> Save</button>';
$btns.='<button class="btn btn-default btn-sm" data-dismiss=modal>Cancel</button>';
$modal->footer($btns);
echo $modal;

