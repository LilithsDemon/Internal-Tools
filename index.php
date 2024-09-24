<?php

ini_set('session.cookie_samesite', "None");

session_start();

if (!isset($_SESSION['username'])) $_SESSION['username'] = "Blank";

if (!isset($_SESSION['auth'])) $_SESSION['auth'] = false;
else if ($_SESSION['auth'] == true) header("Location: ./main.php");

include("./php/include/_connect.php");

if (!isset($_COOKIE['auth'])) setcookie("auth", false, [
  'expires' => time() + 86400,
  'path' => '/',
  'domain' => 'internal.lilithtech.dev',
  'secure' => true,
  'httponly' => true,
  'samesite' => 'None',
]);

else if ($_COOKIE['auth'] == true) header("Location");

?>

<!DOCTYPE html>
<html data-bs-theme="dark" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LD CPM InternalTools</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" type="text/javascript"></script>
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="main.css">
</head>
<body>
<!-- Login 10 - Bootstrap Brain Component -->
<section class="py-3 py-md-5 py-xl-8">
      <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
          <div class="mb-5">
            <div class="text-center mb-4">
              <a href="#!">
                <img src="./assets/logo.png" alt="LilithsDemon Logo" width="128" height="128">
              </a>
            </div>
            <h4 class="text-center mb-2">Welcome back!</h4>
          </div>
          <div class="card border border-light-subtle rounded-4">
            <div class="card-body p-3 p-md-4 p-xl-5">
              <form id="login_form" action="/php/log_in.php" method="post">
                <p class="text-center mb-4">Sign In!</p>
                <div class="row gy-3 overflow-hidden">
                  <div class="col-12">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" name="username" id="username" placeholder="" required>
                      <label for="username" class="form-label">Username</label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-floating mb-3">
                      <input type="password" class="form-control" name="password" id="password" value="" placeholder="Password" required>
                      <label for="password" class="form-label">Password</label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="d-grid">
                      <button class="btn button btn-lg" type="submit">Log in</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            
      </div>
  </section>
  <script src="js/login.js"></script>

</body>
</html>