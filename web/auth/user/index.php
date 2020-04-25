<?php
//jambonbill.org
header('Content-Type: text/html; charset=utf-8');
session_start();

require __DIR__."/../../vendor/autoload.php";


$B=new CRM\Base;

$user=$B->authUser($_GET['id']);

if (isset($user['id'])) {
    echo "<input type=hidden id=user_id value='".$user['id']."'>";
} else {
    header('location: ../users');
    exit;
}

$admin = new LTE\Admin(__DIR__."/../../config/config.json");
echo $admin;

?>
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <section class="content">

        <div class='row'>
            <div class='col-md-6'>
            <?php
            require "box_user.php";
            ?>
            <a href="../users/" class="btn btn-default">Users</a>
            </div>
            <div class='col-md-6'>

            </div>
        </div>

        <div class=row>
            <div class='col-12'>
            <?php
            require "box_debug.php";
            ?>
            </div>
        </div>


    </section>

</div>

<script type="text/javascript" src='js/user.js'></script>

<?php

//print_r($_SESSION);

//$admin->footer("<a href='http://jambonbill.org'>jambonbill.org</a>");
$admin->end();