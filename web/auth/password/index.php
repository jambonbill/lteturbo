<?php
// Password change
header('Content-Type: text/html; charset=utf-8');
session_start();

require __DIR__."/../../../vendor/autoload.php";

$B=new Djang\Base;

if(!$B->isStaff()){
  header('location:/auth/login');
  exit;
}

$admin = new LTE\Admin;
echo $admin;
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Password change</h1>
                </div>
            </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="row">

                <div class="col-6">
                    <?php
                    require "box_password.php";
                    ?>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- ./wrapper -->
<?php
//require "modal_new_sale.php";
$admin->end();