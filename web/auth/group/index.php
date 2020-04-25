<?php

header('Content-Type: text/html; charset=utf-8');
session_start();

require __DIR__."/../../vendor/autoload.php";


$B=new Djang\Base;
$A=new Djang\Auth($B);

if (!$B->isStaff()) {
    header('location:/auth/login');
    exit;
}

if(!isset($_GET['id'])){
    header('location:../auth_groups');
}else{
    $group=$A->group($_GET['id']);
}

if(!$group){
    header('location:../auth_groups');
}

$admin = new LTE\Admin(__DIR__."/../../config/config.json");
echo $admin;
echo '<input type=hidden id=id value="'.$group['id'].'">';
?>
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><i class="fas fa-users-cog"></i> Auth group <?php echo '#'.$group['id'].' - `'.$group['name'].'`'?>
                <small><a href="../auth_groups/">groups</a></small>
            </h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="container">

        <div class='row'>

            <div class='col-md-6'>
            <?php
            //echo '<pre>';print_r($group);echo '</pre>';
            require "box_perms.php";
            ?>
            </div>

            <div class='col-md-6'>
            <?php
            require "box_users.php";
            ?>
            </div>
        </div>

    </section>

</div>

<script type="text/javascript" src='js/main.js'></script>

<?php
require "modal_permissions.php";
require "toast.php";
$admin->end();