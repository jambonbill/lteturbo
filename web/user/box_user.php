<?php
//user info

$body='<div class="row">';

//name
$body.='<div class="col-sm-6">';
$body.='<div class=form-group><label>Username</label>';
$body.='<input type="text" class="form-control form-control-sm" id="username" placeholder="Username" value="'.$user['username'].'" autocomplete=off>';
$body.='</div></div>';

//email
$body.='<div class="col-sm-6">';
$body.='<div class=form-group><label>Email</label>';
$body.='<input type="email" class="form-control form-control-sm" id="email" placeholder="Email" value="'.$user['email'].'" autocomplete=off>';
$body.='</div></div>';

$body.='</div>';

// First name / Last name
$body.='<div class="row">';

$body.='<div class="col-sm-6">';// First name
$body.='<div class=form-group><label>First name</label>';
$body.='<input type="text" class="form-control form-control-sm" id="first_name" placeholder="First name" value="'.$user['first_name'].'" autocomplete=off>';
$body.='</div></div>';

$body.='<div class="col-sm-6">';// Last name
$body.='<div class=form-group><label>Last name</label>';
$body.='<input type="text" class="form-control form-control-sm" id="last_name" placeholder="Last name" value="'.$user['last_name'].'" autocomplete=off>';
$body.='</div></div>';
$body.='</div>';



// Last login / Date joined
$body.='<div class="row">';

$body.='<div class="col-sm-6">';// Last login
$body.='<div class=form-group><label>Last login</label>';
$body.='<input type="text" class="form-control form-control-sm" id="last_login" placeholder="Username" value="'.$user['last_login'].'" readonly>';
$body.='</div></div>';

$body.='<div class="col-sm-6">';// Date joined
$body.='<div class=form-group><label>Date joined</label>';
$body.='<input type="text" class="form-control form-control-sm" id="date_joined" placeholder="Date joined" value="'.$user['date_joined'].'" readonly>';
$body.='</div></div>';

$body.='<div class="col-sm-12">';// Last name

//Is active
$body.='<label><input type="checkbox" class="" id="is_active"> is active</label><br />';
//Is staff
$body.='<label><input type="checkbox" class="" id="is_active"> is staff</label><br />';
//Is superuser
$body.='<label><input type="checkbox" class="" id="is_active"> superuser</label><br />';

$body.='</div>';


$body.='</div>';

/*
<div class="input-group">
    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
    <input type="text" class="form-control" placeholder="Email">
</div>
*/


$box=new LTE\Card;
$box->title("User #".$user['id']);
//$box->icon("fa fa-edit");
$box->body($body);

$btns="<a href=# id=btnSave class='btn btn-sm btn-primary'><i class='fa fa-save'></i> Save</a> ";
$btns.="<a href=# id=btnPassword class='btn btn-sm btn-default'>Change password</a> ";
$btns.="<a href=# id=btnDelete class='btn btn-sm btn-default float-right'><i class='fa fa-trash'></i></a>";

$box->footer($btns);
echo $box;
