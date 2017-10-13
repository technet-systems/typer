<?php
include "system/connect.php";

if (isset($_POST['submit'])) {
	$a_fname = trim($_POST['a_fname']);
	$a_lname = trim($_POST['a_lname']);
	$a_mail = trim($_POST['a_mail']);
	$a_pass = trim(hash('sha256', $_POST['a_pass']));
	$a_temp_pass = time();

	$query = "INSERT INTO `a_users` (
		`a_id` ,
		`a_fname` ,
		`a_lname` ,
		`a_pass` ,
		`a_temp_pass` ,
		`a_mail` ,
		`a_bet_precise` ,
		`a_bet_won` ,
		`a_bet_lost` ,
		`a_status` ,
		`a_level` ,
		`a_a1_id`)
		
		VALUES (
		NULL , '" . $a_fname . "', '" . $a_lname . "', '" . $a_pass . "', '" . $a_temp_pass . "', '" . $a_mail . "', '', '', '', '0', '1', '')";
		
	$result = mysql_query($query);
	
	if (!$result) {
		header("Location: verify-error.html", TRUE, 303);
		die('Adres e-mail już istnieje w bazie: ' . mysql_error());
	}

	//wysyłka maila z hasłem tymczasowym
		$to = $a_mail;
		$message = "Witaj ".$a_fname."!<br><br> Twój kod aktywujący konto to:<b> ".$a_temp_pass."</b><br><br>Powodzenia w typowaniu! :)";
		$subject = 'TYPER - kod aktywacyjny do Twojego konta';
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		$headers .= 'From: typer.scena.net.pl <typer@scena.net.pl>' . "\r\n";
		$headers .= 'Bcc: typer@scena.net.pl' . "\r\n";
		mail($to, $subject, $message, $headers);
	//Koniec
}
?>