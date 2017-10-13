<?php
session_start();

if ((empty($_SESSION['user_logged'])) AND (empty($_SESSION['user_password']))) {
	header ("Location: ../../index.html", TRUE, 303);
	exit;
	
} /* else {
	$query = "SELECT a_id, a_fname FROM a_users WHERE a_mail = '" . $_SESSION['user_logged'] . "'";
	$result = mysql_query($query) or die(mysql_error());
	while ($row = mysql_fetch_array($result)) {
		$a_id = $row['a_id'];
		$a_fname = $row['a_fname'];
	}
} */
?>