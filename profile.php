<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Main Page</title>
  <link rel="stylesheet" href="bootstrap.min.css" media="screen" title="no title"></link><!-- Linking bootstrap css file -->
    <script type="text/javascript" src="bootstrap.min.js"></script>
</head>
<body>
  <?php
  //set the connection

  include "mydbconnect.php";
  session_start();
  $stuid=$_SESSION['sid'];
  $query = "SELECT sname,pwd FROM student WHERE sid='$stuid';";
  $qr1=mysqli_query($con,$query);
  $qr=mysqli_fetch_assoc($qr1);
  $_SESSION['name']=$qr['sname'];
  $pwd=$_SESSION['pwd'];
?>
  <nav class="navbar navbar-inverse">
<div class="container-fluid">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href=""><img alt="logo" src="logo.jpg" width="80%" height="170%" padding="20px" ></a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
      <li class="active"><a href='main.php'><span class="glyphicon glyphicon-star" aria-hidden="true"></span>Home<span class="sr-only">(current)</span></a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li class="active"><a href='logout.php'>Logout<span class="sr-only">(current)</span></a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><?php
      echo "Welcome, ".$qr['sname'];
      ?></a></li>
    </ul>

  </div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->

</nav>
<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" >
</div>
    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" >
      <h1>Profile Settings</h1>
      <hr>
    <!-- Creating a form for the user to register with method post-->
    <form class="form-horizontal" method=post>
  <!-- Bootstrap-->
  <div class="form-group">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <!--taking input for taking Email  -->
      <label for="username" >Username :</label>

      <?php
        $name=$qr['sname'];
       echo"<input name='username' type='text' class='form-control' id='email' value='$name' ></input>";?>
    </div>
  </div>
  <div class="form-group">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <!--Creating input for taking password  -->
      <label for="password" >Password :</label>
      <?php

      echo "<input name='password' type='password' class='form-control' id='password' value='$pwd'></input>";?>
    </div>
  </div>
    <hr>
    <div class="form-group">
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 pull-left">
        <!--Creating a Submit button to submit all the data entered in the form -->
        <button name="button" type="submit"  class="btn btn-primary" style="width:100%;" >Apply Changes</button>
      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6"></div>
      </div>
    </div>

</form>
</div>
<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" ></div>
<?php

//if post button is set
if((isset($_POST["button"])))
{
  //store email and password
  $username=$_POST["username"];
  $p=md5($_POST["password"]);//use md5 encryption
  $_SESSION['pwd']=$_POST["password"];
  //store query
  $sql="UPDATE student set sname = '$username' where sid='$stuid';";
  $sql1="UPDATE student set pwd='$p' where sid='$stuid';";
  //execute query
  $q=mysqli_query($con,$sql);
  $q1=mysqli_query($con,$sql1);
  header("location:profile.php");
    //if no rows is zero that i.e user does not exist
}
//close the connection
$con=NULL;

?>
</body>
</html>
