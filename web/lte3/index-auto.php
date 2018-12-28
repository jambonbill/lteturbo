<?php
// jambonbill.org - LTE3
header('Content-Type: text/html; charset=utf-8');
session_start();

require __DIR__."/../../vendor/autoload.php";

$admin = new LTE\Admin(__DIR__."/../../config/config.json");

//echo $admin->lte3();

?>

<div class="wrapper">

  <?php
  //require "navbar.php";
  //require "sidebar.php";
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
        nope
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->

  <?php
  //require "footer.php";
  require "control_sidebar.php";
  ?>

</div>
<!-- ./wrapper -->
</body>
</html>