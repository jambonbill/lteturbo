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
            <h1>Infobox</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">

        <h5 class="mb-2">Info Box</h5>
        <div class="row">
          <?php
          require "infobox1.php";
          ?>
        </div>
        <!-- /.row -->

        <!-- =========================================================== -->
        <h5 class="mt-4 mb-2">Info Box With <code>bg-*</code></h5>
        <div class="row">
          <?php
          require "infobox2.php";
          ?>
        </div>
        <!-- /.row -->

        <!-- =========================================================== -->
        <h5 class="mt-4 mb-2">Info Box With <code>bg-*-gradient</code></h5>
        <div class="row">
          <?php
          require "infobox3.php";
          ?>
        </div>
        <!-- /.row -->

        <!-- =========================================================== -->

        <!-- Small Box (Stat card) -->
        <h5 class="mb-2 mt-4">Small Box</h5>
        <div class="row">
          <?php
          //require "smallbox.php";
          ?>
        </div>
        <!-- /.row -->

       </div>

</div>
<!-- ./wrapper -->
<?php
$admin->end();