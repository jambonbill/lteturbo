<?php
// jambonbill.org - LTE3
header('Content-Type: text/html; charset=utf-8');
session_start();

require __DIR__."/../../vendor/autoload.php";

$admin = new LTE\Admin(__DIR__."/../../config/config.json");

echo $admin;
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Search</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-12">
              <?php
              echo '<pre>';print_r($_POST);echo '</pre>';
              echo '<pre>';print_r($_GET);echo '</pre>';
              //require "card_tablefull.php";
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