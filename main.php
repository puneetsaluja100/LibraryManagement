<!doctype html>
<!--2015KUCP1018 Anant Sharma
This products.php shows product table from mykart database and a link for logout button with welcome message-->
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Main Page</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/footer-distributed-with-address-and-phones.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="jquery.carouFredSel-6.2.0-packed.js" type="text/javascript"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body>



<!-- Modal -->

  <?php
  //set the connection
  $err="";

  include "mydbconnect.php";
  //start session

  session_start();


  if(isset($_POST["return"]))
  {
  $variable=$_POST['retlist'];
  foreach ($variable as $variablename)
  {
  $sql1="DELETE FROM issue WHERE BookID='$variablename'";
  $q1 = mysqli_query($con,$sql1);
  $sql2 = "UPDATE bookdetails SET Status = 'AV' WHERE BookID  = '$variablename' AND Status = 'NA'";
  $sql4 = "UPDATE bookdetails SET copies = copies+1 WHERE BookID  = '$variablename'";
  $q4 = mysqli_query($con,$sql4);

  $q2 = mysqli_query($con,$sql2);
  $sql3 = "SELECT BookName FROM bookdetails WHERE BookID  = '$variablename'";
  $q3 = mysqli_query($con,$sql3);
  header('location:./main.php');
  }
}









  $stuid=$_SESSION['sid'];
  $query = "SELECT sname FROM student WHERE sid='$stuid';";
  $qr1=mysqli_query($con,$query);
  $qr=mysqli_fetch_assoc($qr1);
  $current_date = date("Y-m-d");
  $fine="SELECT * FROM issue where '$current_date'>ReturnDate;";
  $cf=mysqli_query($con,$fine);
  if(mysqli_num_rows($cf)>0)
{
  $f=25*mysqli_num_rows($cf);
  $err="You have a fine of $f Rs.";
  ?>
  <script type="text/javascript">
     $(document).ready(function(){
         $('#thankyouModal').modal('show');
     });
    </script>
    <?php

}
  if(!isset($_SESSION['sid']))
    {
      //if email not session variable display not set
      echo "Session was not started";
    }
  else {?>
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
    <a class="navbar-brand" style="margin:0%;padding:0%"href=""><img alt="logo" src="kota.jpg" width="100%" height="100%"></a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
      <li class="active"><a href='catalog.php'><span class="glyphicon glyphicon-book" aria-hidden="true"></span> catalaog<span class="sr-only">(current)</span></a></li>
    </ul>
    <form method=post class="navbar-form navbar-left">
      <!--Form consisting of email as text and password as password boxes with login submit button-->
      <div class="form-group">
      <input type=text name=bid class="form-control" id=bid placeholder="Book ID" required></input>
    </div>
      <button type="submit" value="Submit" name="button" class="btn btn-default">Issue</button>
    </form>

    <div class="navbar-form navbar-left">
    <button type="submit" class="btn btn-default" form='myform' onclick=document.getElementById('ret').click()>Return</button>
    </div>


  <?php
  //set the connection

  include "mydbconnect.php";
  if(isset($_POST["button"]))
  {
  $sid = $_SESSION['sid'];
  $id = $_POST["bid"];

  $book  = "SELECT * FROM bookdetails WHERE BookID = '$id' AND copies=0 ";
  $again  = "SELECT * FROM issue WHERE BookID = '$id' AND StudentID = '$sid'";
  $checkagain=mysqli_query($con,$again);
  $no_book = "SELECT * FROM issue WHERE StudentID = '$sid' ";
  $check = mysqli_query($con,$book);
  $check2 = mysqli_query($con,$no_book);
  //$sid = "SELECT sid FROM student
  $issue_date = date("Y-m-d");
  $idate = date_create(date("Y-m-d"));
  date_add($idate,date_interval_create_from_date_string("21 days"));
  $return_date = date_format($idate,"Y-m-d");
  if(mysqli_num_rows($checkagain)==0)
  {
  if(mysqli_num_rows($check2)<4)
  {

    if(mysqli_num_rows($check)==0)
    {
    $sql2 = "INSERT INTO issue VALUES('$issue_date','$return_date','$id','$sid')";
    mysqli_query($con,$sql2);
    $sql3 = "UPDATE bookdetails SET copies = copies-1 WHERE BookID  = '$id' ";
    $q3 = mysqli_query($con,$sql3);
    $sql = "UPDATE bookdetails SET Status = 'NA' WHERE BookID  = '$id' AND Status = 'AV' AND copies=0";
    $q = mysqli_query($con,$sql);
    ?>
    <script type="text/javascript">
       $(document).ready(function(){
           $('#thankyouModal').modal('show');
       });
      </script>
      <?php
    $err ="Your book has been issued successfully!";
    }
    else {
      ?>
      <script type="text/javascript">
         $(document).ready(function(){
             $('#thankyouModal').modal('show');
         });
        </script>
        <?php
      $err = "Sorry! This book is not available";
    }
  }
  else {
    ?>
    <script type="text/javascript">
       $(document).ready(function(){
           $('#thankyouModal').modal('show');
       });
      </script>
      <?php
    $err ="Sorry! Book limit exceeded.";
  }
}
else {
  ?>
  <script type="text/javascript">
     $(document).ready(function(){
         $('#thankyouModal').modal('show');
     });
    </script>
    <?php
  $err="sorry ! You can not issue same book again.";
}






  $_SESSION['bid']=$_POST['bid'];
  }
  //if rows array returned

  ?>


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
  <table align='center' class="table table-hover" style="width:70%">
    <?php
  //table headings
  echo "<TR><TH></TH><TH>Book ID</TH><TH>Book Name</TH><TH>Author</TH><TH>Return Date</TH></TR>";
  //store query
  $student_id = $_SESSION['sid'];
  $sql = "SELECT bookdetails.BookID,bookdetails.BookName,bookdetails.Author,issue.ReturnDate FROM bookdetails JOIN issue on bookdetails.BookID = issue.BookID WHERE StudentID = '".$student_id."'";
  //execute query
  echo "<form id='myForm' method='post'>";
  $q=mysqli_query($con,$sql);
  while($r=mysqli_fetch_assoc($q))
  {
    //print as table rows and cells
    $val = $r['BookID'];
    echo "<TR><TD><input type='checkbox' name='retlist[]' value='$val'></TD>";
    echo sprintf("<TD>%s</TD><TD>%s</TD><TD>%s</TD><TD>%s</TD></TR>",$r['BookID'],$r['BookName'],$r['Author'],$r['ReturnDate']);
  }
  echo "<input name='return' type='submit'  id='ret' value='return' style='display:none' >";

  echo "</form>";
  echo "</table>";




  //if rows array returned
}
if((isset($_POST["input[type='checkbox']"])))
{
    //session variable
    $_SESSION['ids']=$_POST["list"];
    //redirect to products.php
    //header('location:./return.php');
}
$con=NULL;
?>



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





    <div class="modal fade" id="thankyouModal" tabindex="-1" role="dialog" aria-labelledby="thankyouLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Notification</h4>
                </div>
                <div class="modal-body">
                    <?php echo "$err"?>
                </div>
            </div>
        </div>
    </div>






</body>
</html>
