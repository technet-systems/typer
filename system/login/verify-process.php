<?php
include "../../system/connect.php";

$a_temp_pass = $_POST['a_temp_pass'];

if (isset($_POST['submit'])) {
	$query = "SELECT a_temp_pass FROM a_users " . 
	"WHERE a_temp_pass = '" . $a_temp_pass . "' ";
	$result = mysql_query($query) or die(mysql_error());
}
	
if (mysql_num_rows($result) == 1) {
	$query = "UPDATE `a_users` SET `a_status` = '1' WHERE `a_users`.`a_temp_pass` = '" . $a_temp_pass . "'";
	$result = mysql_query($query) or die(mysql_error());
	header ("Location: verify-success.html", TRUE, 303);
	exit;

} else {
	header ("Location: verify-error.html", TRUE, 303);
	exit;
}
?>