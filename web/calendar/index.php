<?php
// jambonbill.org - LTE3
header('Content-Type: text/html; charset=utf-8');
session_start();

require __DIR__."/../../vendor/autoload.php";

$admin = new LTE\Admin(__DIR__."/../../config/config.json");

if(true){
  echo $admin;
}else{
  echo $admin->head();
  echo '<body class="hold-transition sidebar-mini">';
  echo '<div class="wrapper">';
  require "navbar.php";
  require "sidebar.php";
}
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Calendar</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-md-3">
            <?php
            require "card_events.php";
            ?>
          </div>

          <div class="col-md-9">
            <?php
            require "card_calendar.php";
            ?>
          </div>

        </div>
      </div>
    </section>
</div>
<!-- ./wrapper -->
<script type="text/javascript" src="js/calendar.js"></script>
<?php
$admin->end();