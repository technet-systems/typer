<?php
include "../../system/connect.php";
include "../../system/login/check-user.php";

if(isset($_POST['submit'])) {
	$new_pass = hash('sha256', $_POST['pass']);
	
	$query = "UPDATE a_users SET a_pass = '".$new_pass."' WHERE a_id = '".$_SESSION['user_id']."'";
	$result = mysql_query($query) or die(mysql_error());
	header("Location: ../../user.php", TRUE, 303);

} else {
	header("Location: ../../user.php", TRUE, 303);

}
?>