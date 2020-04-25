<?php
/**
 * modal new permission
 * @var LTE
 */



$htm ='<form id=fnew>';
$htm.='<div class="row">';

$htm.='<div class="col-6">';
$htm.='<div class="form-group">';
$htm.='<label>Content type</label>'; //app_label+model
$htm.='<select class="form-control form-control-sm" required>';

$types=$Auth->django_content_types();
$htm.='<option value="">Select';
foreach($types as $type){
	//print_r($type);exit;////Array ( [id] => 1 [app_label] => auth [model] => permission )
	$htm.='<option value="'.$type['id'].'">'.$type['app_label'].'.'.$type['model'];

}
$htm.='</select>';
$htm.='</div>';
$htm.='</div>';

$htm.='</div>';
$htm.='</form>';



$modal=new LTE\Modal;
$modal->id('modalNewPermission');
$modal->icon('fas fa-plus-circle');
$modal->title('New permission(s)');
$modal->body($htm);

$btns='<button id=btnCreate class="btn btn-default btn-sm"><i class="fas fa-save"></i> Create permissions</button>';
$btns.='<button class="btn btn-default btn-sm" data-dismiss="modal"><i class="fas fa-times"></i> Cancel</button>';
$modal->footer($btns);
echo $modal;