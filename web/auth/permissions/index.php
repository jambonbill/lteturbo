<?php

header('Content-Type: text/html; charset=utf-8');
session_start();

require __DIR__."/../../vendor/autoload.php";

$B=new Djang\Base;

if (!$B->isStaff()) {
    header('location:/auth/login');
    exit;
}

$admin = new LTE\Admin(__DIR__."/../../config/config.json");
echo $admin;//

$Auth=new Djang\Auth($B);
?>
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><i class="fas fa-users-cog"></i> Auth permissions
                <small><a href="../auth_groups">auth_groups</a></small>
            </h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="container">

        <div class='row'>

            <div class='col-md-5'>
            <?php
            require "box_contenttypes.php";
            ?>
            </div>

            <div class='col-md-7'>
            <?php
            require "box_permissions.php";

            $B->has_perm('permission.add_permission');//test
            ?>
            </div>
        </div>

    </section>

</div>

<script type="text/javascript" src='js/main.js'></script>

<?php
require "modal_new_permission.php";
$admin->end();