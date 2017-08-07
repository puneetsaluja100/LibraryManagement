<?php
session_start();
require "mydbconnect.php";
  if(isset($_POST["button"]))
  {

    //store email and password
    $id=$_POST["sid"];
    $p=md5($_POST["pwd"]);//use md5 encryption
    //store query
    $sql="SELECT * FROM student WHERE sid='".$_POST["sid"]."' AND pwd='".md5($_POST["pwd"])."'";
    //execute query
    $q=mysqli_query($con,$sql);
    if(mysqli_num_rows($q)!=0)
    {
      $_SESSION['sid']=$_POST['sid'];
      $_SESSION['pwd']=$_POST['pwd'];
      header("Location: main.php");
    }
    else
    {
      header("Location: home.php");
    }
  }

  if((isset($_POST["button1"])))
  { //if button is set to post then insert
    //set the key variables
    $id=$_POST["sid"];
    $sn=$_POST["sname"];
    $mo=$_POST["mobile"];
    $p=md5($_POST["pwd"]);//md5 encryption
    //insert new row
    $sql="INSERT INTO student(sid,sname,mobile,pwd) values('$id','$sn','$mo','$p')";
    //execute query
    $q=mysqli_query($con,$sql);
    //if yes
    if($q==TRUE)
    {

?>
<script type="text/javascript">
$(document).ready(function(){
    $('#thankyouModal').modal('show');
});
</script>


<?php

    }
    else {
      ?>
      <script type='text/javascript'>
      //alert for Unsuccessfull
      alert('Registeration Unsuccessfull!!!');
      //redirect automatically to login.php
      window.location='home.php';

      </script>
      <?php
    }
  }
  //close connection
  $con=NULL;
  ?>



<!DOCTYPE html>

<html lang="en">
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/footer-distributed-with-address-and-phones.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="jquery.carouFredSel-6.2.0-packed.js" type="text/javascript"></script>
  <script src="js/bootstrap.min.js"></script>

  <style type="text/css">
  			html, body {
  				height: 100%;
  				padding: 0;
  				margin: 0;
  			}
  			body {
  				background: #def;
  				min-height: 600px;
  			}
  			body * {
  				font-family: Arial, Geneva, SunSans-Regular, sans-serif;
  				font-size: 14px;
  				line-height: 22px;
  			}

  			#wrapper {
  				width: 50%;
  				height:60%;
  				margin: 1% 5% 0% 5%;
  				overflow: hidden;
  				position: absolute;
  			}
  			#overlay {
  				background: #def;
  				width: 40%;
  				height: 100%;
  				overflow: hidden;
  				position: absolute;
  				left: -40%;
  				top: 0;
  				z-index: 1;

  				-webkit-transition: left .5s ease;
  				-moz-transition: left .5s ease;
  				transition: left .5s ease;
  			}
  			#wrapper:hover #overlay {
  				left: 0px;
  			}
  			#description {
  				padding-left: 10%;
  				width: 90%;
  				height:100%;
          margin-right: 50%;
  				-webkit-transition: margin .5s ease;
  				-moz-transition: margin .5s ease;
  				transition: margin .5s ease;
  			}
  			#wrapper:hover #description {
  				margin-left: 0px;
          margin-right: 20%;
  			}
  			#description h3 {
  				color: #69c;
  				font-size: 35px;
  				font-weight: normal;
  				text-align: right;
  				line-height: 30px;
  				margin: 30px 0;
  			}
  			#description p {
  				font-size: 13px;
  				text-align: justify;
  			}

  			#wrapper .caroufredsel_wrapper {
  				margin-left: 0px !important;

  				-webkit-transition: margin .5s ease;
  				-moz-transition: margin .5s ease;
  				transition: margin .5s ease;
  			}
  			#wrapper:hover .caroufredsel_wrapper {
  				margin-left: 40% !important;
  			}
  			#carousel img {
  				display: block;
  				float: left;
  			}

  			#pager {
  				text-align: center;
  				padding: 40px 20px 0 0;
  			}
  			#pager a {
  				border-radius: 5px;
  				background: #69c;
  				display: block;
  				width: 10px;
  				height: 10px;
  				margin: 0 5px;
  				float: right;
  			}
  			#pager a.selected {
  				background: #333;
  			}
  			#pager span {
  				display: none;
  			}


  			#donate-spacer {
  				height: 100%;
  			}
  			#donate {
  				border-top: 1px solid #999;
  				width: 750px;
  				padding: 50px 75px;
  				margin: 0 auto;
  				overflow: hidden;
  			}
  			#donate p, #donate form {
  				margin: 0;
  				float: left;
  			}
  			#donate p {
  				width: 650px;
  			}
  			#donate form {
  				width: 100px;
  			}
        #hide{
          display:none;
        }
        #log{
          display: none;
        }
        #register{
          display: none;
        }
  		</style>

  <script type="text/javascript">
  			$(function() {
  				$('#carousel').carouFredSel({
  					direction: 'right',
  					items: {
  						visible: 1,
  						start: -1
  					},
  					scroll: {
  						duration: 1000,
  						timeoutDuration: 3000
  					},
  					pagination: '#pager'
  				});
  			});
  		</script>

</head>
<body style="background-color:black">
<nav class="navbar navbar-inverse" style="height:5%">
<div class="container-fluid">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header" style="margin:0%;padding:0%">
    <a class="navbar-brand" style="margin:0%;padding:0%"href=""><img alt="logo" src="kota.jpg" width="100%" height="100%"></a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


    <ul class="nav navbar-nav navbar-right">
      <li id="top" class="active"><a onclick="function1();" id="reg"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
        Register
        <span class="sr-only" >(current)</span></a></li>
      <li id="top" class="active"><a onclick="function2();" id="log"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
        Login
        <span class="sr-only" >(current)</span></a></li>
      <li id="top" class="active"><a href="contact.html"><span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
          Contact Us
          <span class="sr-only" >(current)</span></a></li>

    </ul>

  </div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
</nav>

<div id="wrapper">
			<div id="carousel">
				<img src="img/library1.jpg"  />
				<img src="img/library2.jpg"  />
				<img src="img/library3.jpg"  />
				<img src="img/library4.jpg"  />
			</div>
			<div id="overlay">
				<div id="description">
					<h3>IIIT KOTA</h3>
          <p>To create a center for imparting technical education of international standards and conduct research at the cutting edge of technology to meet the current and future challenges of technological development.</p>
					<div id="pager"></div>
				</div>
			</div>
		</div>





    <form class="form-horizontal" id="login" style="float:right;padding-right:5%;padding-top:1%;height:60%;width:40%"  method="post">
        <div class="form-group" style="height:20%;padding-top:5%">
        <div class="col-sm-offset-4 col-sm-8" style="font-size:40px;color:#506fa8">
          Login
        </div>
      </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-4 control-label" style="color:#506fa8;font-size:20px">User ID</label>
          <div class="col-sm-8">
            <input type="text" name="sid" class="form-control" id="inputEmail3" placeholder="user ID" style="width:80%" required>
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-4 control-label"style="color:#506fa8;font-size:20px" >Password </label>
          <div class="col-sm-8">
            <input type="password" name="pwd" class="form-control" id="inputPassword3" placeholder="Password" style="width:80%" required>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-4 col-sm-8">
            <button type="submit" name="button" id="button" class="btn btn-default ">Sign In</button>
          </div>
        </div>
      </form>

      <form class="form-horizontal" id="register" style="float:right;padding-right:5%;padding-top:1%;height:60%;width:40%" method="post">
        <div class="form-group" style="height:20%;padding-top:5%">
        <div class="col-sm-offset-4 col-sm-8" style="font-size:40px;color:#506fa8">
          Register
        </div>
      </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-4 control-label" style="color:#506fa8;font-size:20px">User Name</label>
          <div class="col-sm-8">
            <input type="text" name="sname" class="form-control" id="inputEmail3" placeholder="user Name" style="width:80%" required>
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-4 control-label" style="color:#506fa8;font-size:20px">User ID</label>
          <div class="col-sm-8">
            <input type="text" name="sid" class="form-control" id="inputEmail3" placeholder="user ID" style="width:80%" required>
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-4 control-label"style="color:#506fa8;font-size:20px" >Mobile No</label>
          <div class="col-sm-8">
            <input type="number" name="mobile" class="form-control" id="inputPassword3" placeholder="Password" style="width:80%" required>
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-4 control-label"style="color:#506fa8;font-size:20px" >Password </label>
          <div class="col-sm-8">
            <input type="password" name="pwd" class="form-control" id="inputPassword3" placeholder="Confirm Password" style="width:80%" required>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-4 col-sm-8">
            <button type="submit" name="button1" id="button1" class="btn btn-default,btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Register</button>
          </div>
        </div>
    </form>


<footer style="position:fixed;bottom:0px;height:15%;padding-bottom:12%" class="footer-distributed">

			<div class="footer-left">

				<h3>IIIT KOTA</h3>


				<p class="footer-company-name">Indian Institute<br> of Information <br>Technology Kota</p>
			</div>

			<div class="footer-center">

				<div>
					<i class="fa fa-map-marker"></i>
					<p class="footer-company-about">
            <span>Office of IIIT Kota, 2nd Floor<br>Prabha Bhawan MNIT Jaipur,<br> Jaipur-302017 </span>
          </p>
				</div>

				<div>
					<i class="fa fa-phone"></i>
					<p>+0141-2713494</p>
				</div>

				<div>
					<i class="fa fa-envelope"></i>
					<p><a href="iiitkota.ac.in">iiitkota.ac.in</a></p>
				</div>

			</div>

			<div class="footer-right">

				<p class="footer-company-about">
					<span>About the institute</span>
            IIIT Kota is a joint venture of the Ministry of Human Resource Development, Rajasthan Government with Industries in Public-Private Partnership model.
				</p>

				<div class="footer-icons">

					<a href="#"><i class="fa fa-facebook"></i></a>
					<a href="#"><i class="fa fa-twitter"></i></a>
					<a href="#"><i class="fa fa-linkedin"></i></a>
					<a href="#"><i class="fa fa-github"></i></a>

				</div>

			</div>

		</footer>

    <script type="text/javascript" src="js/myscript.js" ></script>


    <div class="modal fade" id="thankyouModal" tabindex="-1" role="dialog" aria-labelledby="thankyouLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Thank you for pre-registering!</h4>
            </div>
            <div class="modal-body">
                <p>You'll be the first to know when Shopaholic launches.</p>
                <p>In the meantime, any <a href="http://shopaholic.uservoice.com/" target="_blank">feedback</a> would be much appreciated.</p>
            </div>
        </div>
    </div>
</div>


</body>
</html>
