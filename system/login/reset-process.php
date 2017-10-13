<?php
include "../../system/connect.php";

if (isset($_POST['submit'])) {
	
	$query = "SELECT a_id, a_fname, a_mail FROM a_users " . 
	"WHERE a_mail = '" . $_POST['email'] . "' "; 
	
	$result = mysql_query($query) or die(mysql_error());
//poniższe while można ew. przesunąć pod warunek if sprawdzający czy jest taki mail, który podał użytkownik (mysql_num_rows)
	while ($row = mysql_fetch_array($result)) {
		$a_id = $row['a_id'];
		$a_fname = $row['a_fname'];
		$a_mail = $row['a_mail'];
	}

	if (mysql_num_rows($result) == 1) {
		$a_mail = $_POST['email'];
		
		$a_temp_pass = time();
		
		$a_hash_temp_pass = hash('sha256', $a_temp_pass);
		
		$query = "UPDATE a_users SET a_pass = '" . $a_hash_temp_pass . "' WHERE a_id = '" . $a_id . "'";
		
		$result = mysql_query($query) or die(mysql_error());
		
//wysyłka maila z hasłem tymczasowym
		$to = $a_mail;
		$message = "Witaj ".$a_fname."!<br><br> Twoje tymczasowe hasło to: <b>".$a_temp_pass."</b><br><br>Powodzenia w typowaniu! :)";
		$subject = 'TYPER - tymczasowe hasło do Twojego konta';
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		$headers .= 'From: typer.scena.net.pl <typer@scena.net.pl>' . "\r\n";
		$headers .= 'Bcc: typer@scena.net.pl' . "\r\n";
		mail($to, $subject, $message, $headers);
//Koniec
		
		header ("Location: verify-success.html", TRUE, 303);
		exit;
	} else {
		header ("Location: verify-error.html", TRUE, 303);
		exit;
	}
}
?>