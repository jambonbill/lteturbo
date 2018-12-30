<?php
/**
 * Modal new user
 */


$htm='<div class="row">';

$htm.='<div class="col-12">';
$htm.='<div class="form-group">';
$htm.='<label>Email</label>';
$htm.='<input type="email" class="form-control form-control-sm" placeholder="email" autocomplete="off">';
$htm.='</div>';
$htm.='</div>';

$htm.='<div class="col-6">';
$htm.='<div class="form-group">';
$htm.='<label>First name</label>';
$htm.='<input type="text" class="form-control form-control-sm" placeholder="First" autocomplete="off">';
$htm.='</div>';
$htm.='</div>';

$htm.='<div class="col-6">';
$htm.='<div class="form-group">';
$htm.='<label>Last name</label>';
$htm.='<input type="text" class="form-control form-control-sm" placeholder="Last name" autocomplete="off">';
$htm.='</div>';
$htm.='</div>';
$htm.='</div>';


$modal=new LTE\Modal;
$modal->id('modalUserNew');
$modal->title('New user');
$modal->body($htm);
$modal->footer('<button id=btnSave class="btn btn-default btn-sm"><i class="fa fa-save"></i> Save new user</button>');
echo $modal;