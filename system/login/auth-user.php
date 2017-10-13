<?php
session_start();
//include "../system/connect.php";
$connect = mysql_connect("CHANGE_ME", "CHANGE_ME", "CHANGE_ME") or die(mysql_error());
$db = mysql_select_db('CHANGE_ME', $connect) or die(mysql_error());
mysql_query("SET NAMES 'utf8'");

if (isset($_POST['submit'])) {
	$query = "SELECT a_mail, a_pass FROM a_users " . 
	"WHERE a_mail = '" . $_POST['email'] . "' " . 
	"AND a_pass = '" . hash('sha256', $_POST['pass']) . "'";
	$result = mysql_query($query) or die(mysql_error());
}
	
if (mysql_num_rows($result) == 1) {
	$_SESSION['user_logged'] = $_POST['email'];
	$_SESSION['user_password'] = hash('sha256', $_POST['pass']);
	
	$query = "SELECT a_id, a_status, a_level FROM a_users WHERE a_mail = '" . $_SESSION['user_logged'] . "' ";
	$result = mysql_query($query) or die(mysql_error());
	while ($row = mysql_fetch_assoc($result)) {
		$a_id = $row['a_id'];
		$a_status = $row['a_status'];
		$a_level = $row['a_level'];
	}
	
	$_SESSION['user_id'] = $a_id;
	$_SESSION['user_level'] = $a_level;
	
	if ($a_status == 0 AND $a_level == 1) {
		header("Location: verify-error.html", TRUE, 303);
		exit;
	} else if ($a_status == 1 AND $a_level == 1) {
		header("Location: ../../start.php", TRUE, 303);
		exit;
	} else if ($a_status == 1 AND $a_level == 2) { //tutaj można się zastanowić czy tego nie wywalić, zakładając, że zakładki po zalgowaniu będą zależne od a_level'u w SQLu
		header("Location: ../../start.php", TRUE, 303);
		exit;
	}
	
	//header ("Location: ../../start.php", TRUE, 303);
	//exit;

} else {
	header("Location: verify-error.html", TRUE, 303);
	exit;
}
?>
