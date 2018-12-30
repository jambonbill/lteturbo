<?php

header('Content-Type: text/html; charset=utf-8');
session_start();

require __DIR__ . "/../../vendor/autoload.php";

$admin = new LTE\Admin(__DIR__."/../../config/config.json");
//$admin->title("Login");
//$admin->config()->menu = (object)[];//unset the global menu
//$admin->config()->layout->{'sidebar-collapse'}=true;
echo $admin->head();
?>

<body class="text-center">
    <form class="form-signin" method="post" action="login.php" autocomplete="off">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" name=email id="inputEmail" class="form-control" 
      placeholder="Email address" required autofocus autocomplete="off">
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" name="password" id="inputPassword" class="form-control" 
      placeholder="Password" required autocomplete="off">
      
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>
</body>

<style type="text/css">
html,
body {
  height: 100%;
}

body {
  display: -ms-flexbox;
  display: -webkit-box;
  display: flex;
  -ms-flex-align: center;
  -ms-flex-pack: center;
  -webkit-box-align: center;
  align-items: center;
  -webkit-box-pack: center;
  justify-content: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f5;
}

.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}

.form-signin .form-control {
  position: relative;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>