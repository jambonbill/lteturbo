<?php
//box filter

$htm='<div class="row">';

$htm.='<div class="col-12">';
$htm.='<div class="form-group">';
$htm.='<label>Search</label>';
$htm.='<input type="text" id=search class="form-control form-control-sm" placeholder="Search" autocomplete="off">';
$htm.='</div>';
$htm.='</div>';

//User
$htm.='<div class="col-12">';
$htm.='<div class="form-group">';
$htm.='<label>User</label>';
$htm.='<select class="form-control form-control-sm" id=user>';
$htm.='<option value="">Every users';
//list staff
$sql="SELECT DISTINCT id, username FROM auth_user WHERE is_staff>0 AND is_active>0 ORDER BY username;";
$q=$B->db()->query($sql) or die("Error: $sql");
//$staff=[];
while($r=$q->fetch(PDO::FETCH_ASSOC)){
	//print_r($r);
	$htm.='<option value="'.$r['id'].'">'.htmlentities(ucfirst($r['username']));
}
$htm.='</select>';
$htm.='</div>';
$htm.='</div>';

// Channel
$channels=['djang','Lead','Activity','Student'];
$htm.='<div class="col-12">';
$htm.='<div class="form-group">';
$htm.='<label>Channel</label>';
$htm.='<select class="form-control form-control-sm" id=channel>';
$htm.='<option value="">Everything';
foreach($channels as $v){
	$htm.='<option value="'.htmlentities($v).'">'.htmlentities($v);
}
$htm.='</select>';
$htm.='</div>';
$htm.='</div>';

$htm.='<div class="col-12">';
$htm.='<div class="form-group">';
$htm.='<label>Date</label>';
$htm.='<input type="date" id=date class="form-control form-control-sm" placeholder="date">';
$htm.='</div>';
$htm.='</div>';


$htm.='<div class="col-12">';
$htm.='<div class="form-group">';
$htm.='<label>Limit</label>';
$htm.='<select class="form-control form-control-sm" id=limit>';
$htm.='<option value="30">30';
$htm.='<option value="100">100';
$htm.='<option value="500">500';
//$htm.='<option value="500">500';
$htm.='</select>';
$htm.='</div>';
$htm.='</div>';


$htm.='</div>';


$box=new LTE\Card;
$box->id('boxFilter');
//$box->icon('fa fa-search');
//$box->title('Filter');
$box->body($htm);
//$box->small('small text');
$box->loading(1);
echo $box;