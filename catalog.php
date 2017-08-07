<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Main Page</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>


<?php
//set the connection
include "mydbconnect.php";



session_start();
$stuid=$_SESSION['sid'];
$query = "SELECT sname FROM student WHERE sid='$stuid';";
$qr1=mysqli_query($con,$query);
$qr=mysqli_fetch_assoc($qr1);

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
  <a class="navbar-brand" style="margin:0%;padding:0%"href=""><img alt="logo" src="kota.jpg" width="100%" height="100%"></a>
</div>

<!-- Collect the nav links, forms, and other content for toggling -->
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
  <ul class="nav navbar-nav">
    <li class="active"><a href='main.php'><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home<span class="sr-only">(current)</span></a></li>
  </ul>
  <form class="navbar-form navbar-left" method="post">
    <div class="form-group">
      <input type="text" name="input" class="form-control" placeholder="Search">
    </div>
    <form class="navbar-form navbar-left">
      <div class="form-group">
        <div class="dropdown">
          <button type="button" class="btn btn-default">                 <!-- a dropdown is created-->
            <select id="dropdown" type="text" name="catalog">
              <option value=1>Book name</option>
              <option value=2>Author</option>
              <option value=3>publication</option>
            </select>
            </button>
          </div>
        </div>
        <form class="navbar-form navbar-left">
        <button type="submit" name="search" class="btn btn-default">Submit</button>
      </form>
    </form>
  </form>


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


<?php
if((isset($_POST["search"])))
{
  $input=$_POST['input'];
  $value=$_POST['catalog'];
  if($value==1)
  {
    $book = "SELECT * FROM BookDetails where BookName like "."'$input%'".";";
    $q=mysqli_query($con,$book);
  }
  elseif($value==2)
  {
    $book = "SELECT * FROM BookDetails where Author like "."'$input%'".";";
    $q=mysqli_query($con,$book);
  }
  elseif($value==3)
  {
    $book = "SELECT * FROM BookDetails where Publication like "."'$input%'".";";
    $q=mysqli_query($con,$book);
  }
}
else {
$sql = "SELECT * FROM BookDetails;";
$q=mysqli_query($con,$sql);
}
//if rows array returned
?>

<table align='center' class="table table-hover table-striped" style="width:80%">
  <?php
echo "<TR class="."danger"."><TH>ID</TH><TH>Book Name</TH><TH>Author</TH><TH>Publication</TH><TH>Status</TH><TH>Price</TH><TH>Copies</TH></TR>";
while($r=mysqli_fetch_assoc($q))
{
  //print as table rows and cells
  echo sprintf("<TR class="."active"."><TD>%s</TD><TD>%s</TD><TD>%s</TD><TD>%s</TD><TD>%s</TD><TD>%s</TD><TD>%s</TD></TR>",$r['BookID'],$r['BookName'],$r['Author'],$r['Publication'],$r['Status'],$r['Price'],$r['copies']);
}
echo "</table>";
?>



</body>
</html>
