<?php
include "../../system/connect.php";
include "../../system/login/check-user.php";

$query = "SELECT a_send FROM a_users WHERE a_id = '".$_SESSION['user_id']."'";
$result = mysql_query($query) or die(mysql_error());

while ($row = mysql_fetch_array($result)) {
	$a_send = $row['a_send'];
}

if($a_send == 1) {
$send = '';
$send .=<<<EOD
	<input type="checkbox" name="send[]" value="$a_send" class="input-xlarge" checked>
EOD;
} else {
$send = '';
$send .=<<<EOD
	<input type="checkbox" name="send[]" value="$a_send" class="input-xlarge">
EOD;
}

if(isset($_POST['submit'])) {
	if(isset($_POST['send'])) {
		$query = "UPDATE a_users SET a_send = 1 WHERE a_id = '".$_SESSION['user_id']."'";
		$result = mysql_query($query) or die(mysql_error());
		
	} else {
		$query = "UPDATE a_users SET a_send = 0 WHERE a_id = '".$_SESSION['user_id']."'";
		$result = mysql_query($query) or die(mysql_error());
	
	}
	
	header("Location: ../../user.php", TRUE, 303);

} 

?>