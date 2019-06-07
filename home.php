<html>
    <head>
        <meta charset="utf-8" />
        <title> User Identification System </title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
        <!--     Fonts and icons     -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <!-- CSS Files -->
        <link href="./assets/css/material-kit.css?v=2.0.5" rel="stylesheet" />
        <script src="./assets/js/core/jquery.min.js" type="text/javascript"></script>
        <script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
        <script src="./assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
        <script src="./assets/js/plugins/moment.min.js"></script>
        <script> function goBack(){ window.location.replace('home.php'); }</script>
    </head>
    <body>
            <nav class="navbar navbar-expand-lg bg-danger">
                    <div class="container">
                            <a style="display: block;margin-left: auto;margin-right: auto;width: 40%;text-align: center;" class="navbar-brand" href="#">User Identification System</a>
                    </div>
            </nav>

            <?php include 'php/connection.php';?>
            
            </br></br></br></br>
            <div class="card card-nav-tabs text-center" STYLE="width: 50%;margin: auto;"id="mycard">
                <div class="card-header card-header-warning">
                    Web based User Identification System
                </div>
                <div class="card-body"  >
                    <h4 class="card-title">Enter Details</h4>
                    <form class="form" method="post" action="#">
                        <div class="form-group" >
                            <label for="exampleInputEmail1">Aadhar Number</label>
                            <input type="text" class="form-control" name="aadhar" aria-describedby="uid" placeholder="Enter unique aadhar number">
                            <small id="uid" class="form-text text-muted">Aadhaar is a verifiable 12-digit identification number issued by UIDAI to the resident of India for free of cost.</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" name="pass" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-warning">Submit</button>
                    </form>
                </div>
            </div>

            <div class="card-footer text-muted" style="position: fixed; left: 0; bottom: 0; width: 100%; background-color: #f4f4f4; text-align: center;">
                    <p><h6>❮ Built with 🧡 by AzizStark ❯</h6></p>
            </div>
    </body>    
</html>        

<?php
    if (!empty($_POST)){
        $uid = $_POST['aadhar'];
        $pas = $_POST['pass'];

        $dbpass=oci_parse($conn, 'SELECT PASS FROM login');
        oci_execute($dbpass);
        oci_fetch($dbpass);
        $chkpas=oci_result($dbpass,'PASS');

        if ($pas == $chkpas){
            $dbuser=oci_parse($conn, 'SELECT IMAGE FROM IMAGE_TABLE WHERE aid=:aadhar');
            oci_bind_by_name($dbuser, ':aadhar', $uid);
            oci_execute($dbuser);
            oci_fetch($dbuser);
            $chkusr=oci_result($dbuser,'IMAGE');

            echo"<script>document.getElementById('mycard').innerHTML = '';//alert('Person Identified');</script>";


            $name = oci_parse($conn, 'SELECT * FROM IMAGE_TABLE WHERE aid=:aadhar');
            oci_bind_by_name($name, ':aadhar', $uid);
            oci_execute($name);
            oci_fetch($name);
            $name1=oci_result($name,'UNAME');
            $stat=oci_result($name,'STATUS');
            $gend=oci_result($name,'GENDER');
            $pers=oci_result($name,'PERSONALTY');
            $occu=oci_result($name,'OCCU');
            $age=oci_result($name,'AGE');
            

            echo('<div class="card card-nav-tabs text-center" STYLE="width: 50%;margin: auto;"id="mycard">
            <div class="card-header card-header-warning">
                Web based User Identification System
            </div>
                <div class="card-body">
                    <h4 class="card-title">Person Details</h4>
                        <img align="left" width="250" class="img-fluid img-thumbnail" height="250" src="data:image/jpeg;base64,'.base64_encode( $chkusr ).'"/>
                        <div class="info1" align="left" style="position:absolute; padding:5px 0px; left:40%">
                            <h4> Name: '.$name1.' </h4>
                            <h4>Age: '.$age.'  </h4>
                            <h4>Occupation: '.$occu.'   </h4>
                            <h4>Gender: '.$gend.'   </h4>
                            <h4>Personality: '.$pers.'   </h4>
                            <h4>Status: '.$stat.'   </h4>
                            <button  onclick="goBack()" style="left: 30px;" type="back" class="btn btn-warning">Back</button>
                        </div>
                </div>
                </br></br>
            </div>');}
         else{
            echo("<script>alert('Invalid password.')</script>");
         } 
    }
?>    