<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
require __DIR__."/../../vendor/autoload.php";

$admin = new LTE\Admin;
$admin->config()->menu=(object)[];//unset the global menu
$admin->title("403");
echo $admin->head();//
?>
<div class="content-wrapper">
    <section class="content">

    <div class='row'>
      <div class='col-12'>

        <h1 style="font-size:128px">403</h1>
        <h1 style="font-size:64px">Forbiden <small></small></h1>

      </div>
    </div>
    </section>
</div>
<?php
$admin->end();