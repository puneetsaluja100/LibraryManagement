<?php
/*2015KUCP1018 Anant Sharma
unset the session and redirect*/
//start the current session
session_start();
//unset the session ids
unset($_SESSION['sid']);
//destroy the current session
session_destroy();
?>
<script type='text/javascript'>
//alert for logout
alert('Logged Out Successfully!!!');
//redirect automatically to login.php
window.location='home.php';

</script>
