<?php


//echo '<pre>';print_r($_GET);echo '</pre>';

$search='';
if (isset($_GET['q'])) {
    $search=trim($_GET['q']);
}

$htm='<div class="row">';

$htm.='<div class="col-12">';
$htm.='<div class="form-group">';
$htm.='<label>Search</label>';
$htm.='<input type="text" class="form-control form-control-sm" placeholder="Your search" value="'.htmlentities($search).'">';
$htm.='</div>';
$htm.='</div>';

$htm.='</div>';



$box=new LTE\Card;
$box->id('boxSearch');
//$box->title('Search');
$box->body($htm);
//$box->small('small text');
$btns='<button class="btn btn-default btn-sm" id=btnSave disabled><i class="fa fa-save"></i> Save</button>';
//$box->footer($btns);
//$box->collapsable(true);
$box->loading(0);
echo $box;