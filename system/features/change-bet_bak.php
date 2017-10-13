<?php
include "../../system/connect.php";
include "../../system/login/check-user.php";

$new_bets = '';
$query = "SELECT b1_id AS Mecz, b1_datetime AS Data_i_czas, t1.b_name AS Druzyna_1, t2.b_name AS Druzyna_2, b1_result_team_1 AS Wynik_1, b1_result_team_2 AS Wynik_2, t1.b_flag AS Flaga_1, t2.b_flag AS Flaga_2 
FROM b1_match 
inner join b_team t1 on t1.b_id = b1_match.b1_b_id_team_1 
inner join b_team t2 on t2.b_id = b1_match.b1_b_id_team_2
ORDER BY b1_id ASC";

$result = mysql_query($query) or die(mysql_error());

while ($row = mysql_fetch_array($result)) {
	$Mecz = $row['Mecz'];
	$Data_i_czas = $row['Data_i_czas'];
	$Druzyna_1 = $row['Druzyna_1'];
	$Druzyna_2 = $row['Druzyna_2'];
	$Wynik_1 = $row['Wynik_1'];
	$Wynik_2 = $row['Wynik_2'];
	$Flaga_1 = $row['Flaga_1'];
	$Flaga_2 = $row['Flaga_2'];
	
list($date, $time) = explode(" ", $Data_i_czas);
	
$new_bets .=<<<EOD
<tr>
    <td>$Mecz</td>
    <td>$date<br><b>$time</b></td>
    <td class="right_align">$Druzyna_1 <img src="images/flags/$Flaga_1"></td>
	<td class="center_align"><b>$Wynik_1 - $Wynik_2</b></td>
    <td><img src="images/flags/$Flaga_2"> $Druzyna_2</td>
    <td class="center_align">
        <a href="#myModal$Mecz" data-toggle="modal"><i class="icon-pencil"></i></a>
    </td>
</tr>
EOD;
}
$new_bets_window = '';
$query = "SELECT b1_id AS Mecz, b1_datetime AS Data_i_czas, t1.b_name AS Druzyna_1, t2.b_name AS Druzyna_2, b1_result_team_1 AS Wynik_1, b1_result_team_2 AS Wynik_2, t1.b_flag AS Flaga_1, t2.b_flag AS Flaga_2 
FROM b1_match 
inner join b_team t1 on t1.b_id = b1_match.b1_b_id_team_1 
inner join b_team t2 on t2.b_id = b1_match.b1_b_id_team_2
ORDER BY b1_id ASC";

$result = mysql_query($query) or die(mysql_error());

while ($row = mysql_fetch_array($result)) {
	$Mecz = $row['Mecz'];
	$Data_i_czas = $row['Data_i_czas'];
	$Druzyna_1 = $row['Druzyna_1'];
	$Druzyna_2 = $row['Druzyna_2'];
	$Wynik_1 = $row['Wynik_1'];
	$Wynik_2 = $row['Wynik_2'];
	$Flaga_1 = $row['Flaga_1'];
	$Flaga_2 = $row['Flaga_2'];

$new_bets_window .=<<<EOD
<div class="modal small hide fade" id="myModal$Mecz" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<form action="system/features/change-bet.php?Mecz=$Mecz" method="POST">
	<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Podaj swój typ</h3>
	</div>
  <div class="modal-body">
	<table class="table list">
      <tbody>
        <tr>
          <td class="right_align">$Druzyna_1 <img src="images/flags/$Flaga_1"></td>
		  <td class="center_align">
		  <input type="text" name="Wynik_1" value="$Wynik_1" maxlength="2" size="2" class="span3" pattern="[0-9]" required> - 
		  <input type="text" name="Wynik_2" value="$Wynik_2" maxlength="2" size="4" class="span3" pattern="[0-9]" required>
		  </td>
          <td><img src="images/flags/$Flaga_2"> $Druzyna_2</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="modal-footer">
    <input type="submit" name="submit" value="Typuj" class="btn btn-primary pull-right">
  </div>
  </form>
</div>
EOD;
}

if (isset($_POST['submit'])) {
	$query = "INSERT INTO a2_bets (a2_id, a2_b1_id, a2_result_team_1, a2_result_team_2, a2_a_id, a2_timestamp) VALUES (NULL , '".$_REQUEST['Mecz']."', '".$_POST['Wynik_1']."', '".$_POST['Wynik_2']."', '".$_SESSION['user_id']."', CURRENT_TIMESTAMP)";
	$result = mysql_query($query) or die(mysql_error());
	header("Location: ../../start.php", TRUE, 303);
}
?>