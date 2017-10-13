<?php
$connect = mysql_connect("CHANGE_ME", "CHANGE_ME", "CHANGE_ME") or die(mysql_error());
$db = mysql_select_db('CHANGE_ME', $connect) or die(mysql_error());
mysql_query("SET NAMES 'utf8'");
?>
