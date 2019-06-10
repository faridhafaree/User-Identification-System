<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    USER IDENTIFICATION SYSTEM
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="./assets/css/material-kit.css?v=2.0.5" rel="stylesheet" />
</head>

<body class="login-page">
  <nav class="navbar-transparent navbar-color-on-scroll fixed-top " color-on-scroll="100" id="sectionsNav">
    <div class="container">
      <div class="navbar-translate">
        <a class="navbar-brand" style="color:azure; display: block;margin-left: auto;margin-right: auto;width: 40%;text-align: center; padding:25px 10px;" href="#"> User Identification System</a>
        <?php include 'php/connection.php';?>
      </div>
    </div>
  </nav>
  <div class="page-header header-filter" style="background-image: url('./assets/img/MissionControlGrid.png'); background-size: cover; background-position: top center;">
    <div class="container">
      <div class="row">
        <div class="col-md-2 col-md-4 ml-auto mr-auto">
          <div class="card card-login">
            <form class="form" method="post" action="#">
              <h2 class="description text-center">Login</h2>
              <div class="card-body">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">face</i>
                    </span>
                  </div>
                  <input type="text" name="name" class="form-control" placeholder="First Name...">
                </div>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">lock_outline</i>
                    </span>
                  </div>
                  <input type="password" name="pass" class="form-control" placeholder="Password...">
                </div>
              </div>
                <button id="loggon" style="padding: 15px 24px;position:absolute;left:50%;top:50%;margin-left:-45px;margin-top:110px;" type="submit" class="btn btn-primary">Login</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <footer class="footer">
      <div class="container">
        <div class="copyright float-center">
          <h6>❮ Built with 🧡 by FARIDHA ❯</h6>
        </div>
      </div>
    </footer>
  </div>
  <!--   Core JS Files   -->
  <script src="./assets/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="./assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
  <script src="./assets/js/plugins/moment.min.js"></script>
</body>

</html>

<?php
if (!empty($_POST)){
      $user = $_POST['name'];
      $pass = $_POST['pass'];

      $dbuser=oci_parse($conn, 'SELECT users FROM login');
      oci_execute($dbuser);
      oci_fetch($dbuser);
      $chkusr=oci_result($dbuser,'USERS');

      $dbpass=oci_parse($conn, 'SELECT PASS FROM login');
      oci_execute($dbpass);
      oci_fetch($dbpass);
      $chkpas=oci_result($dbpass,'PASS');

      if($user == $chkusr and $chkpas == $pass){
      echo"<script>alert('Login Successful! Welcome $user'); window.location.replace('home.php');</script>";
      $isst=1;
      }
else{
  echo("<script>alert('Login Failed. Incorrect details.')</script>");
}      
}
?>    
