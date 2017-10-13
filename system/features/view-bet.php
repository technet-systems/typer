<?php
include "../../system/connect.php";
include "../../system/login/check-user.php";

$today = date("Y-m-d H:i:s");

$bets = '';
$query = "SELECT a2_b1_id AS Mecz, COUNT(a2_b1_id) AS Typow, a2_datetime AS Data_i_czas, t1.b_name AS Druzyna_1, t2.b_name AS Druzyna_2,  SUM(a2_result_team_2)/SUM(a2_result_team_1+1) AS Wynik_1, SUM(a2_result_team_1)/SUM(a2_result_team_2+1) AS Wynik_2, t1.b_flag AS Flaga_1, t2.b_flag AS Flaga_2 
FROM a2_bets 
inner join b_team t1 on t1.b_id = a2_bets.a2_team_1 
inner join b_team t2 on t2.b_id = a2_bets.a2_team_2 
WHERE a2_status = 0 
GROUP BY a2_b1_id ASC";
$result = mysql_query($query) or die(mysql_error());

while ($row = mysql_fetch_array($result)) {
	$a2_b1_id = $row['Mecz'];
	$Druzyna_1 = $row['Druzyna_1'];
	$Druzyna_2 = $row['Druzyna_2'];
	$Wynik_1 = round($row['Wynik_1']+1, 2);
	$Wynik_2 = round($row['Wynik_2']+1, 2);
	$Flaga_1 = $row['Flaga_1'];
	$Flaga_2 = $row['Flaga_2'];
	$count_a2_b1_id = $row['Typow'];
	
	$bets .=<<<EOD
		<tr>
          <td>$a2_b1_id</td>
          <td class="right_align">$Druzyna_1 <img src="images/flags/$Flaga_1"></td>
		  <td class="center_align"><b>$Wynik_1 - $Wynik_2</b></td>
          <td><img src="images/flags/$Flaga_2"> $Druzyna_2</td>
          <td class="center_align">$count_a2_b1_id</td>
        </tr>
EOD;
	}

$new_bets = ''; //już wykorzystany w matches.php
$query = "SELECT b1_id AS Mecz, b1_datetime AS Data_i_czas, t1.b_name AS Druzyna_1, t2.b_name AS Druzyna_2, b1_result_team_1 AS Wynik_1, b1_result_team_2 AS Wynik_2, t1.b_flag AS Flaga_1, t2.b_flag AS Flaga_2 
FROM b1_match 
INNER JOIN b_team t1 ON t1.b_id = b1_match.b1_b_id_team_1 
INNER JOIN b_team t2 ON t2.b_id = b1_match.b1_b_id_team_2 
WHERE (b1_id) NOT IN (SELECT DISTINCT a2_b1_id FROM a2_bets WHERE a2_a_id = '".$_SESSION['user_id']."') AND b1_status = 0 AND NOW() <= b1_datetime 
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
$new_bets_window = ''; //już wykorzystany w matches.php
$query = "SELECT b1_id AS Mecz, b1_datetime AS Data_i_czas, b1_b_id_team_1 AS id_team_1, b1_b_id_team_2 AS id_team_2, t1.b_name AS Druzyna_1, t2.b_name AS Druzyna_2, b1_result_team_1 AS Wynik_1, b1_result_team_2 AS Wynik_2, t1.b_flag AS Flaga_1, t2.b_flag AS Flaga_2 
FROM b1_match 
inner join b_team t1 on t1.b_id = b1_match.b1_b_id_team_1 
inner join b_team t2 on t2.b_id = b1_match.b1_b_id_team_2
ORDER BY b1_id ASC";

$result = mysql_query($query) or die(mysql_error());

while ($row = mysql_fetch_array($result)) {
	$Mecz = $row['Mecz'];
	$Data_i_czas = $row['Data_i_czas'];
	$id_team_1 = $row['id_team_1'];
	$id_team_2 = $row['id_team_2'];
	$Druzyna_1 = $row['Druzyna_1'];
	$Druzyna_2 = $row['Druzyna_2'];
	$Wynik_1 = $row['Wynik_1'];
	$Wynik_2 = $row['Wynik_2'];
	$Flaga_1 = $row['Flaga_1'];
	$Flaga_2 = $row['Flaga_2'];

$new_bets_window .=<<<EOD
<div class="modal small hide fade" id="myModal$Mecz" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<form action="system/features/view-bet.php?Mecz=$Mecz&Data_i_czas=$Data_i_czas&id_team_1=$id_team_1&id_team_2=$id_team_2" method="POST">
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
		  <input type="text" name="Wynik_1" value="$Wynik_1" maxlength="2" size="2" class="span3" pattern="[0-9]{1,2}" required> - 
		  <input type="text" name="Wynik_2" value="$Wynik_2" maxlength="2" size="4" class="span3" pattern="[0-9]{1,2}" required>
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
	$query = "INSERT INTO a2_bets (a2_id, a2_b1_id, a2_datetime, a2_team_1, a2_team_2, a2_result_team_1, a2_result_team_2, a2_a_id, a2_timestamp) VALUES (NULL , '".$_REQUEST['Mecz']."', '".$_REQUEST['Data_i_czas']."', '".$_REQUEST['id_team_1']."', '".$_REQUEST['id_team_2']."', '".$_POST['Wynik_1']."', '".$_POST['Wynik_2']."', '".$_SESSION['user_id']."', CURRENT_TIMESTAMP)";
	$result = mysql_query($query) or die(mysql_error());
	header("Location: ../../matches.php", TRUE, 303);
}

$my_bets = '';
$query = "SELECT a2_b1_id AS Mecz, a2_datetime AS Data_i_czas, t1.b_name AS Druzyna_1, t2.b_name AS Druzyna_2, a2_result_team_1 AS Wynik_1, a2_result_team_2 AS Wynik_2, t1.b_flag AS Flaga_1, t2.b_flag AS Flaga_2 
FROM a2_bets 
inner join b_team t1 on t1.b_id = a2_bets.a2_team_1 
inner join b_team t2 on t2.b_id = a2_bets.a2_team_2 
WHERE a2_a_id = '".$_SESSION['user_id']."' AND a2_status = 0 
ORDER BY a2_b1_id ASC";
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

$my_bets .=<<<EOD
<tr>
	<td>$Mecz</td>
    <td>$date<br><b>$time</b></td>
    <td class="right_align">$Druzyna_1 <img src="images/flags/$Flaga_1"></td>
	<td class="center_align"><b>$Wynik_1 - $Wynik_2</b></td>
    <td><img src="images/flags/$Flaga_2"> $Druzyna_2</td>
    <td class="center_align">
        <a href="#myModalChange$Mecz" data-toggle="modal"><i class="icon-edit"></i></a>
    </td>
</tr>
EOD;
}

$change_bets_window = '';
$query = "SELECT b1_id AS Mecz, b1_datetime AS Data_i_czas, b1_b_id_team_1 AS id_team_1, b1_b_id_team_2 AS id_team_2, t1.b_name AS Druzyna_1, t2.b_name AS Druzyna_2, b1_result_team_1 AS Wynik_1, b1_result_team_2 AS Wynik_2, t1.b_flag AS Flaga_1, t2.b_flag AS Flaga_2 
FROM b1_match 
inner join b_team t1 on t1.b_id = b1_match.b1_b_id_team_1 
inner join b_team t2 on t2.b_id = b1_match.b1_b_id_team_2
ORDER BY b1_id ASC";

$result = mysql_query($query) or die(mysql_error());

while ($row = mysql_fetch_array($result)) {
	$Mecz = $row['Mecz'];
	$Data_i_czas = $row['Data_i_czas'];
	$id_team_1 = $row['id_team_1'];
	$id_team_2 = $row['id_team_2'];
	$Druzyna_1 = $row['Druzyna_1'];
	$Druzyna_2 = $row['Druzyna_2'];
	$Wynik_1 = $row['Wynik_1'];
	$Wynik_2 = $row['Wynik_2'];
	$Flaga_1 = $row['Flaga_1'];
	$Flaga_2 = $row['Flaga_2'];

$change_bets_window .=<<<EOD
<div class="modal small hide fade" id="myModalChange$Mecz" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<form action="system/features/view-bet.php?Mecz=$Mecz&Data_i_czas=$Data_i_czas&id_team_1=$id_team_1&id_team_2=$id_team_2" method="POST">
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
		  <input type="text" name="Wynik_1" value="$Wynik_1" maxlength="2" size="2" class="span3" pattern="[0-9]{1,2}" required> - 
		  <input type="text" name="Wynik_2" value="$Wynik_2" maxlength="2" size="4" class="span3" pattern="[0-9]{1,2}" required>
		  </td>
          <td><img src="images/flags/$Flaga_2"> $Druzyna_2</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="modal-footer">
    <input type="submit" name="change" value="Typuj" class="btn btn-primary pull-right">
  </div>
  </form>
</div>
EOD;
}

$league = '';
$query = "SELECT a_mail, b_flag, SUM(a2_points), COUNT(a2_b1_id) FROM a_users, b_team, a2_bets WHERE b_id = a_favorite AND a2_a_id = a_id AND a2_status > 0 GROUP BY a_mail ORDER BY SUM(a2_points) DESC";
$result = mysql_query($query) or die(mysql_error());

while ($row = mysql_fetch_array($result)) {
	$a_mail = $row['a_mail'];
	$b_flag = $row['b_flag'];
	$sum_a2_points = $row['SUM(a2_points)'];
	$count_a2_b1_id = $row['COUNT(a2_b1_id)'];
	
	list($a_nick_mail) = explode("@", $a_mail);

$league .=<<<EOD
<tr>
	<td class="center_align">
        <p><i class="icon-user"></i> $a_nick_mail</p>
    </td>
    <td class="center_align">
        <p>$count_a2_b1_id</p>
    </td>
    <td class="center_align">
        <p>$sum_a2_points</p>
    </td>
	<td class="center_align"><img src="images/flags/$b_flag"></td>
</tr>
EOD;
}

$history_bets = '';
$query = "SELECT a2_b1_id AS Mecz, a2_datetime AS Data_i_czas, t1.b_name AS Druzyna_1, t2.b_name AS Druzyna_2, a2_result_team_1 AS Wynik_1, a2_result_team_2 AS Wynik_2, t1.b_flag AS Flaga_1, t2.b_flag AS Flaga_2, a2_points AS Punkty 
FROM a2_bets 
inner join b_team t1 on t1.b_id = a2_bets.a2_team_1 
inner join b_team t2 on t2.b_id = a2_bets.a2_team_2 
WHERE a2_a_id = '".$_SESSION['user_id']."' AND a2_status != 0 
ORDER BY a2_b1_id ASC";
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
	$Punkty = $row['Punkty'];
	
list($date, $time) = explode(" ", $Data_i_czas);

$query1 = "SELECT b1_result_team_1, b1_result_team_2 FROM b1_match WHERE b1_id = '".$Mecz."'";
$result1 = mysql_query($query1) or die(mysql_error());

while ($row1 = mysql_fetch_array($result1)) {
	$b1_result_team_1 = $row1['b1_result_team_1'];
	$b1_result_team_2 = $row1['b1_result_team_2'];
}
$history_bets .=<<<EOD
	<tr>
        <td>$Mecz</td>
        <td>$date<br>$time</td>
        <td class="right_align">$Druzyna_1 <img src="images/flags/$Flaga_1"></td>
		<td class="center_align"><b>$b1_result_team_1 - $b1_result_team_2</b><br> Mój typ ($Wynik_1 - $Wynik_2)</td>
        <td><img src="images/flags/$Flaga_2"> $Druzyna_2</td>
        <td class="center_align">
            <a href="#" class="demo-cancel-click" rel="tooltip" title="Mój typ ($Wynik_1 - $Wynik_2)"><i class="icon-$Punkty"></i></a>
        </td>
    </tr>
EOD;

}

if (isset($_POST['change'])) {
	$query = "SELECT a2_datetime FROM a2_bets WHERE a2_b1_id = '".$_REQUEST['Mecz']."' AND a2_a_id = '".$_SESSION['user_id']."'";
	$result = mysql_query($query) or die(mysql_error());
	while ($row = mysql_fetch_array($result)) {
		$a2_datetime = $row['a2_datetime'];	
	}
	if ($a2_datetime > $today) {
		$query = "UPDATE a2_bets SET a2_result_team_1 = '".$_POST['Wynik_1']."', a2_result_team_2 = '".$_POST['Wynik_2']."' WHERE a2_b1_id = '".$_REQUEST['Mecz']."' AND a2_a_id = '".$_SESSION['user_id']."'";
		$result = mysql_query($query) or die(mysql_error());
		header("Location: ../../bets.php", TRUE, 303);
	} else {
		header("Location: ../../bets.php", TRUE, 303);
	}
} 
?>