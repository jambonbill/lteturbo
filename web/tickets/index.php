<?php
//jambonbill.org
header('Content-Type: text/html; charset=utf-8');
session_start();

require __DIR__."/../../vendor/autoload.php";



$B=new CRM\Base();
if(!$B->is_staff()){
	header('location:../login');
	exit;
}

$T=new CRM\Ticket($B);

//$dat=$T->tickets();
//print_r($dat);exit;

$admin = new LTE\Admin(__DIR__."/../../config/config.json");
echo $admin;//

//echo '<pre>';print_r($J->user());echo '</pre>';
?>

<div class="content-wrapper">

	<section class="container">
	  <h1>Tickets</h1>
	</section>


	<section class="container">

		<div class='row'>
			<div class='col-md-3'>
			<?php
			require "box_filter.php";
			?>
			</div>
			<div class='col-md-9'>
			<?php
			require "box_tickets.php";
			?>
			</div>
		</div>

	</section>

</div>

<script type="text/javascript" src='js/tickets.js'></script>

<?php
require "modal_ticket.php";
//echo $J->footer();
$admin->end();