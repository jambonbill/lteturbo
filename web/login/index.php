<?php

header('Content-Type: text/html; charset=utf-8');
session_start();

require __DIR__ . "/../../vendor/autoload.php";

$admin = new LTE\Admin(__DIR__."/../../config/config.json");
echo $admin->head();
?>

<body class="hold-transition login-page">

  <div class="login-box">

  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="login.php" method="post" autocomplete="off">
        <div class="input-group mb-3">
          <input type="email" name=email id="inputEmail" class="form-control" placeholder="Email" autocomplete="off">
          <div class="input-group-append">
              <span class="fa fa-envelope input-group-text"></span>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name=password id="inputPassword" class="form-control" placeholder="Password">
          <div class="input-group-append">
              <span class="fa fa-lock input-group-text"></span>
          </div>
        </div>
        <div class="row">
          <div class="col-8">

          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>



      <p class="mb-1">
        <a href="#">I forgot my password</a>
      </p>

    </div>
    <!-- /.login-card-body -->
  </div>

<script type="text/javascript">
  document.getElementById('inputEmail').focus();
</script>
</body>