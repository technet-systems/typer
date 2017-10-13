<?php
include "../../system/connect.php";
include "../../system/login/check-user.php";

$query = "UPDATE a_users SET a_favorite = '" . $_REQUEST['b_id'] . "' WHERE a_id = '" . $_REQUEST['a_id'] . "'";
$result = mysql_query($query) or die(mysql_error());
header("Location: ../../start.php", TRUE, 303);
?>