<?php
/**
 *
 */
header('Content-Type: text/html; charset=utf-8');
session_start();

require __DIR__."/../../vendor/autoload.php";

$admin = new LTE\Admin;
$admin->configfile(__DIR__."/../../config/config.json");
//$admin->description("Testing the tests is my hobby");
echo $admin;


?>
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Home</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!--Main content-->
    <section class="container">

        <div class="row">

            <div class="col-12">
                <?php

                $C=new LTE\Callout("warning", "Callout", "This is a new LTE\Callout");
                $C->icon('fa fa-warning');
                echo $C;

                $A=new LTE\Alert("info", "Alert", "I'm a new LTE\Alert and i can be removed");
                echo $A;
                ?>
            </div>

            <div class="col-md-12">
                <?php

                $tools='<div class="has-feedback">';
                $tools.='<input class="form-control form-control-sm" placeholder="Search ..." type="text">';
                $tools.='<span class="glyphicon glyphicon-search form-control-feedback"></span>';
                $tools.='</div>';

                $htm='<pre>hi</pre>';

                $box=new LTE\Card;
                $box->title("Card");
                //$box->tools($tools);
                $box->body($htm);
                $box->removable(1);
                $box->collapsable(1);
                echo $box;


                $box=new LTE\Card;
                $box->title("Collapsable");
                //$box->tools($tools);
                $box->body('collpasable');
                $box->collapsable(1);
                echo $box;

                $box=new LTE\Card;
                $box->title("Collapsed");
                //$box->tools($tools);
                $box->body('collapsed ?');
                $box->collapsed(1);
                echo $box;
                //echo '<pre>';print_r($_SESSION);echo '</pre>';
                ?>
            </div>

        </div>

    </section>
</div>
<?php
$admin->end();