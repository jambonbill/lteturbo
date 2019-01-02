<?php
//user info

$box=new LTE\Card;
//$box->title("User #".$user['id']);
//$box->icon("fa fa-edit");
$box->body("<pre>".print_r($user,true)."</pre>");
$box->removable(1);
echo $box;