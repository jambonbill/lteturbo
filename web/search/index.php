<?php
/**
 * Search page
 */

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
            <h1><i class="fa fa-search"></i></h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <?php
                require "card_search.php";
                ?>
            </div>
            <div class="col-md-12">
                <?php
                require "card_result.php";
                ?>
            </div>
        </div>

      </div>
    </section>
</div>



<!-- ./wrapper -->

<?php
$admin->end();