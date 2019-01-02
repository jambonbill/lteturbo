<?php
/**
 * Invoice
 */
header('Content-Type: text/html; charset=utf-8');
session_start();

require __DIR__."/../../vendor/autoload.php";

if (false) {
    header('location:../login');
    exit;
}

$admin = new LTE\Admin(__DIR__."/../../config/config.json");
echo $admin;//

?>
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Invoice</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="container">

        <div class='row'>
            <div class='col-md-1'>
            <?php
            //require "box_filter.php";
            //require "box_users.php";
            ?>
            </div>
            <div class='col-md-10'>
            <?php
            require "invoice.php";
            ?>
            </div>
        </div>

    </section>

</div>

<?php
$admin->end();