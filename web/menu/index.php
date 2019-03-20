<?php
// jambonbill.org - LTE3
header('Content-Type: text/html; charset=utf-8');
session_start();

require __DIR__."/../../vendor/autoload.php";

$admin = new LTE\Admin(__DIR__."/../../config/config.json");

$admin->keyword('email','testtoto@waandoo.fr');
$admin->keyword('username','Brandon glasburn');
//exit($admin->keyValue('email'));
//$nb=$admin->navbar();
//print_r($nb->items[0]);exit;
//$nb->items[0]->text="youaou@waou.de";
//print_r($nb);exit;
//$x = (object)[];
//$x->items=[];
//$admin->navbar($nb);
echo $admin;
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Menu</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-6">
              <?php
              require "card_menu.php";
              ?>
          </div>
          <div class="col-6">
              <?php
              require "box_navbar.php";
              ?>
          </div>
        </div>

      </div>
    </section>
</div>

<!-- ./wrapper -->
<script type="text/javascript">
  $(function(){
    $('.overlay').hide();
  });
</script>
<?php
$admin->end();