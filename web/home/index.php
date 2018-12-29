<?php

header('Content-Type: text/html; charset=utf-8');
session_start();

require __DIR__."/../../vendor/autoload.php";

$admin = new LTE\Admin;
//$admin->configfile(__DIR__."/configtest.json");
$admin->configfile(__DIR__."/../../config/config.json");
//$admin->description("Testing the tests is my hobby");
echo $admin;

//echo "<pre>";print_r($admin->meta());exit;
//https://adminlte.io/themes/AdminLTE/index2.html
//$UD=new Django\UserDjango;
?>
<div class="content-wrapper">

<!--Content header-->
<section class="content-header">
  <h1>
    Home
    <small>sweet home</small>
  </h1>
</section>

<!--Main content-->
<section class="container">

	<div class="row">

		<div class="col-12">
			<?php

			$C=new LTE\Callout("warning","Callout","This is a new LTE\Callout");
			echo $C;

			$A=new LTE\Alert("info","Alert","I'm a new LTE\Alert and i can be removed");
			echo $A;
			?>
		</div>

		<div class="col-md-6">
			<?php

			$tools='<div class="has-feedback">';
            $tools.='<input class="form-control form-control-sm" placeholder="Search ..." type="text">';
            $tools.='<span class="glyphicon glyphicon-search form-control-feedback"></span>';
            $tools.='</div>';

			$box=new LTE\Card;
			$box->title("Box");
			$box->tools($tools);
			$box->body("[]");
			//$box->removable(1);
			//$box->collapsable(1);
			echo $box;

			//echo '<pre>';print_r($_SESSION);echo '</pre>';
			?>
		</div>

	</div>

</section>
</div>
<?php
$admin->end();