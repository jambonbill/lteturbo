<?php

header('Content-Type: text/html; charset=utf-8');
session_start();

require __DIR__."/../../../vendor/autoload.php";

$B=new Djang\Base;

if (!$B->isStaff()) {
    header('location:/auth/login');
    exit;
}

$admin = new LTE\Admin("config.json");
echo $admin;//

?>
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><i class="fas fa-users-cog"></i> Auth groups
                <small><a href="../auth_users/">auth users</a></small>
            </h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="container">

        <div class='row'>

            <div class='col-md-4'>
            <?php
            require "box_groups.php";
            ?>
            </div>

            <div class='col-md-8'>
            <?php
            require "box_users.php";
            ?>
            </div>
        </div>

    </section>

</div>

<script type="text/javascript" src='js/main.js'></script>

<?php
//require "modal_usernew.php";
$admin->end();