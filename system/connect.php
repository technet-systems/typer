<?php
$connect = mysql_connect("localhost", "technets_typer", "S15WLkDEJN") or die(mysql_error());
$db = mysql_select_db('technets_typer', $connect) or die(mysql_error());
mysql_query("SET NAMES 'utf8'");
?>