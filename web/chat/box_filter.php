<?php

$htm='<div class="row">';

$htm.='<div class="col-md-12">';
$htm.='<div class="form-group">';
$htm.='<label>Search</label>';
$htm.='<input type="text" class="form-control form-control-sm" placeholder="Search">';
$htm.='</div>';
$htm.='</div>';

$htm.='<div class="col-md-12">';
$htm.='<div class="form-group">';
$htm.='<label>Role</label>';
$htm.='<select class="form-control form-control-sm">';
$htm.='<option>Every role';
$htm.='</select>';
$htm.='</div>';
$htm.='</div>';

$htm.='<div class="col-md-12">';
$htm.='<div class="form-group">';
$htm.='<label>Legend</label>';
$htm.='<input type="text" class="form-control form-control-sm" placeholder="Placeholder">';
$htm.='</div>';
$htm.='</div>';

$htm.='</div>';


$box=new LTE\Card;
$box->id('boxFilter');
$box->title('Filter');
$box->body($htm);
//$box->small('small text');
//$box->footer('<button class="btn btn-default btn-sm" id=btnSave disabled><i class="fa fa-save"></i> Save</button>');
//$box->collapsable(true);
$box->loading(1);
echo $box;