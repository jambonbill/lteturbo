<?php

header('Content-Type: text/html; charset=utf-8');
session_start();

require __DIR__."/../../vendor/autoload.php";

$admin = new LTE\Admin;
$admin->title("Home");
echo $admin;

// https://adminlte.io/themes/AdminLTE/index2.html

$UD=new Django\UserDjango;

?>
<!--Content header-->
<section class="content-header">
  <h1>
    Home
    <small>sweet home</small>
  </h1>
</section>

<!--Main content-->
<section class="content-header">
	<div class="row">
		<div class="col-12">
			<?php
			$C=new LTE\Callout("warning","Callout","This is a new LTE\Callout");
			echo $C;

			$A=new LTE\Alert("info","Alert","I'm a new LTE\Alert and i can be removed");
			echo $A;
			?>
		</div>
		<div class="col-6">
			<?php
			
			$tools='<div class="has-feedback">';
            $tools.='<input class="form-control input-sm" placeholder="Search ..." type="text">';
            $tools.='<span class="glyphicon glyphicon-search form-control-feedback"></span>';
            $tools.='</div>';

			$box=new LTE\Box;
			$box->title("Box");
			$box->tools($tools);
			$box->body("[]");
			$box->removable(1);
			$box->collapsable(1);
			echo $box;
			?>
		</div>
		<div class="col-6">
		<?php
		$box=new LTE\Box;
		$box->id('boxId');
		//$box->icon('fa fa-edit');
		$box->title('title');
		//$box->small('subtitle');
		$box->body('<pre>no data</pre>');
		$box->footer('<a href=# class="btn btn-default"><i class="fa fa-save"></i> Save</a>');
		$box->collapsable(1);
		//$box->loading(0);
		echo $box;
		?>
		</div>
	</div>

</section>


