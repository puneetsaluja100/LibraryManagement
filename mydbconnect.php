<?php
/*2015KUCP1018 Anant Sharma
set the connection to mysql server first import dump file mykart.sql to phpmyadmin*/
//my server is localhost , user: root, password:root and database : mykart
 $con=mysqli_connect('localhost','root','','library');
//check for errors
if($con!=NULL)
  echo "";
else
    echo "Try again";
 ?>
