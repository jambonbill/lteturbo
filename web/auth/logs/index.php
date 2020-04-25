<?php
//logs
header('Content-Type: text/html; charset=utf-8');
session_start();

require __DIR__."/../../../vendor/autoload.php";



$B=new Djang\Base();
if (!$B->isStaff()) {
    header('location:/auth/login');
    exit;
}

$admin = new LTE\Admin;
echo $admin;//
?>

<div class="content-wrapper">

    <section class="container">
      <h1>Djang Logs</h1>
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
            require "box_logs.php";
            ?>
            </div>
        </div>

    </section>

</div>

<script type="text/javascript" src='js/main.js'></script>

<?php
//require "modal_ticket.php";
$admin->end();