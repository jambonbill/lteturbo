<?php
/**
 * Box password
 * @var string
 */


$htm ='<form id=fpass method=post action="changepassword.php">';
$htm.='<div class="row">';

$htm.='<div class="col-12">';
$htm.='<div class="form-group">';
$htm.='<label>New password</label>';
$htm.='<input type="password" id=p1 name=p1 class="form-control form-control-sm" required placeholder="at least 8 characters">';
$htm.='</div>';
$htm.='</div>';

$htm.='<div class="col-12">';
$htm.='<div class="form-group">';
$htm.='<label>Repeat new password</label>';
$htm.='<input type="password" id=p2 name=p2 class="form-control form-control-sm" required placeholder="repeat">';
$htm.='</div>';
$htm.='</div>';

$htm.='</div>';
$htm.='</form>';


$box=new LTE\Card;
$box->id('boxPassword');
$box->icon('fas fa-key');
$box->title('New password');
$box->body($htm);
//$box->small('small text');
$btns='<button class="btn btn-default btn-sm" id=btnUpdate disabled><i class="fa fa-save"></i> Change my password</button>';
$box->footer($btns);
//$box->collapsable(true);
//$box->p0(1);
//$box->loading(1);
echo $box;
?>
<script type="text/javascript">
$(()=>{
    'use strict';
    $('#boxPassword').change(()=>{
        let p1=$('#p1').val();
        let p2=$('#p2').val();
        if(p1&&p1==p2){
            $('#btnUpdate').attr("disabled",false).addClass("btn-primary").removeClass("btn-default");
        }
    });

    $('#btnUpdate').click(function(){
        fpass.submit();
    });

    $('#p1').focus();
});
</script>