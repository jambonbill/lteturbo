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
            <h1>Simple tables</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-md-6">
            <?php
            //require "card_table_simple.php";
            ?>
          </div>

          <div class="col-md-6">
            <?php
            //require "card_table_striped.php";
            ?>
          </div>

        </div>

        <div class="row">
          <div class="col-12">
              <?php
              require "card_tablefull.php";
              ?>
          </div>
        </div>

        more at https://adminlte.io/themes/dev/AdminLTE/pages/tables/simple.html#


      </div>
    </section>
</div>



<!-- ./wrapper -->

<?php
$admin->end();