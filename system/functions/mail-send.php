<?php
include "/typer/system/connect.php";
//lista najbliższych 5-ciu meczy od dnia dzisiejszego now() i o statusie 0
$query = "SELECT b1_id AS Mecz, b1_datetime AS Data_i_czas, t1.b_name AS Druzyna_1, t2.b_name AS Druzyna_2, b1_result_team_1 AS Wynik_1, b1_result_team_2 AS Wynik_2, t1.b_flag AS Flaga_1, t2.b_flag AS Flaga_2 
FROM b1_match 
INNER JOIN b_team t1 ON t1.b_id = b1_match.b1_b_id_team_1 
INNER JOIN b_team t2 ON t2.b_id = b1_match.b1_b_id_team_2 
WHERE b1_datetime > NOW() AND b1_status = 0
ORDER BY b1_id ASC LIMIT 0,5";

$result = mysql_query($query) or die(mysql_error());

$upcomming_matches_details = '';
while ($row = mysql_fetch_array($result)) {
	$Mecz = $row['Mecz'];
	$Data_i_czas = $row['Data_i_czas'];
	$Druzyna_1 = $row['Druzyna_1'];
	$Druzyna_2 = $row['Druzyna_2'];
	$Wynik_1 = $row['Wynik_1'];
	$Wynik_2 = $row['Wynik_2'];
	$Flaga_1 = $row['Flaga_1'];
	$Flaga_2 = $row['Flaga_2'];
	
	$upcomming_matches_details .=<<<EOD
	<tr>
		<td>$Mecz. </td>
		<td>$Data_i_czas: </td>
		<td>$Druzyna_1 - </td>
		<td>$Druzyna_2 / </td>
	<tr>
	
EOD;
}
/*
$upcomming_matches_header =<<<EOD
<table border="0" align="left" cellpadding="3" cellspacing="1">
	<tr>
		<th>Mecz / </th>
		<th>Termin / </th>
		<th>Drużyna 1 / </th>
		<th>Drużyna 2 / </th>
	</tr>
EOD;
*/
$upcomming_matches_footer =<<<EOD
</table>
EOD;

$upcomming_matches_complete =<<<TABLE
	$upcomming_matches_details
	$upcomming_matches_footer
TABLE;

$query = "SELECT a_mail, a_fname FROM a_users WHERE a_send = 1";
$result = mysql_query($query) or die(mysql_error());
while ($row = mysql_fetch_array($result)) {
	$a_mail = $row['a_mail'];
	$a_fname = $row['a_fname'];
	
	//wysyłka maila z przypomnieniem o meczu
	$to = $a_mail;
	$message = "Witaj ".$a_fname."!<br><br> Najbliższe mecze: <br><br><b>".$upcomming_matches_complete."</b><br><br>Powodzenia w typowaniu! :) <br><br><a href='http://typer.scena.net.pl'>typer.scena.net.pl</a>";
	$subject = 'TYPER - najbliższe mecze';
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
	$headers .= 'From: typer.scena.net.pl <daru79@scena.net.pl>' . "\r\n";
	$headers .= 'Bcc: daru79@scena.net.pl' . "\r\n";
	mail($to, $subject, $message, $headers);
//Koniec
	
}

?>