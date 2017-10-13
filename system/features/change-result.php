<?php
include "../../system/connect.php";
include "../../system/login/check-user.php";
//include "../../system/functions/check-bet-function.php";

$new_bets = '';
$query = "SELECT b1_id AS Mecz, b1_datetime AS Data_i_czas, t1.b_name AS Druzyna_1, t2.b_name AS Druzyna_2, b1_result_team_1 AS Wynik_1, b1_result_team_2 AS Wynik_2, t1.b_flag AS Flaga_1, t2.b_flag AS Flaga_2 
FROM b1_match 
INNER JOIN b_team t1 ON t1.b_id = b1_match.b1_b_id_team_1 
INNER JOIN b_team t2 ON t2.b_id = b1_match.b1_b_id_team_2 
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
$query = "SELECT b1_id AS Mecz, b1_datetime AS Data_i_czas, b1_b_id_team_1 AS id_team_1, b1_b_id_team_2 AS id_team_2, t1.b_name AS Druzyna_1, t2.b_name AS Druzyna_2, b1_result_team_1 AS Wynik_1, b1_result_team_2 AS Wynik_2, t1.b_flag AS Flaga_1, t2.b_flag AS Flaga_2, t1.b_group AS Grupa_1, t2.b_group AS Grupa_2 
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
	$Grupa_1 = $row['Grupa_1'];
	$Grupa_2 = $row['Grupa_2'];
	$Wynik_1 = $row['Wynik_1'];
	$Wynik_2 = $row['Wynik_2'];
	$Flaga_1 = $row['Flaga_1'];
	$Flaga_2 = $row['Flaga_2'];

$new_bets_window .=<<<EOD
<div class="modal small hide fade" id="myModal$Mecz" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<form action="system/features/change-result.php?Mecz=$Mecz&Data_i_czas=$Data_i_czas&id_team_1=$id_team_1&id_team_2=$id_team_2&Grupa_1=$Grupa_1" method="POST">
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
	$query = "UPDATE b1_match SET b1_result_team_1 = '".$_POST['Wynik_1']."', b1_result_team_2 = '".$_POST['Wynik_2']."', b1_status = 1 WHERE b1_id = '".$_REQUEST['Mecz']."'";
	$result = mysql_query($query) or die(mysql_error());
	
	$result_1 = $_POST['Wynik_1'];
	$result_2 = $_POST['Wynik_2'];
	$match = $_REQUEST['Mecz'];
	
	//obliczanie punktów obu drużyn
	if ($_REQUEST['Mecz'] <= 48) {
	
	if ($_POST['Wynik_1'] > $_POST['Wynik_2']) {
	
	$query = "UPDATE b_team SET b_points = b_points+3, b_matches = b_matches+1, b_won = b_won+1, b_goals_for = b_goals_for + '".$_POST['Wynik_1']."', b_goals_against = b_goals_against + '".$_POST['Wynik_2']."', b_goal_difference = b_goal_difference + '".$_POST['Wynik_1']."'-'".$_POST['Wynik_2']."' WHERE b_id = '".$_REQUEST['id_team_1']."'";
	$result = mysql_query($query) or die(mysql_error());
	
	$query = "UPDATE b_team SET b_matches = b_matches+1, b_lost = b_lost+1, b_goals_for = b_goals_for + '".$_POST['Wynik_2']."', b_goals_against = b_goals_against + '".$_POST['Wynik_1']."', b_goal_difference = b_goal_difference + '".$_POST['Wynik_2']."'-'".$_POST['Wynik_1']."' WHERE b_id = '".$_REQUEST['id_team_2']."'";
	$result = mysql_query($query) or die(mysql_error());
	
	} else if ($_POST['Wynik_1'] < $_POST['Wynik_2']) {
	
	$query = "UPDATE b_team SET b_points = b_points+3, b_matches = b_matches+1, b_won = b_won+1, b_goals_for = b_goals_for + '".$_POST['Wynik_2']."', b_goals_against = b_goals_against + '".$_POST['Wynik_1']."', b_goal_difference = b_goal_difference + '".$_POST['Wynik_2']."'-'".$_POST['Wynik_1']."' WHERE b_id = '".$_REQUEST['id_team_2']."'";
	$result = mysql_query($query) or die(mysql_error());
	
	$query = "UPDATE b_team SET b_matches = b_matches+1, b_lost = b_lost+1, b_goals_for = b_goals_for + '".$_POST['Wynik_1']."', b_goals_against = b_goals_against + '".$_POST['Wynik_2']."', b_goal_difference = b_goal_difference + '".$_POST['Wynik_1']."'-'".$_POST['Wynik_2']."' WHERE b_id = '".$_REQUEST['id_team_1']."'";
	$result = mysql_query($query) or die(mysql_error());
	
	} else if ($_POST['Wynik_1'] == $_POST['Wynik_2']) {
	
	$query = "UPDATE b_team SET b_points = b_points+1, b_matches = b_matches+1, b_drawn = b_drawn+1, b_goals_for = b_goals_for + '".$_POST['Wynik_1']."', b_goals_against = b_goals_against + '".$_POST['Wynik_2']."', b_goal_difference = b_goal_difference + '".$_POST['Wynik_1']."'-'".$_POST['Wynik_2']."' WHERE b_id = '".$_REQUEST['id_team_1']."'";
	$result = mysql_query($query) or die(mysql_error());
	
	$query = "UPDATE b_team SET b_points = b_points+1, b_matches = b_matches+1, b_drawn = b_drawn+1, b_goals_for = b_goals_for + '".$_POST['Wynik_2']."', b_goals_against = b_goals_against + '".$_POST['Wynik_1']."', b_goal_difference = b_goal_difference + '".$_POST['Wynik_2']."'-'".$_POST['Wynik_1']."' WHERE b_id = '".$_REQUEST['id_team_2']."'";
	$result = mysql_query($query) or die(mysql_error());
	
	}
	$query = "SELECT AVG(b_matches) FROM b_team WHERE b_group = '".$_REQUEST['Grupa_1']."'";
	$result = mysql_query($query) or die(mysql_error());
	
	while ($row = mysql_fetch_array($result)) {
		$avg_b_matches = $row['AVG(b_matches)'];
	}
	
	if ($avg_b_matches == 3) {
	
	//wyciągnięcie meczów w których grają zwycięzcy grup (dla każdego z osobna niestety :/)
	/*
	$query = "SELECT b1_id FROM b1_match WHERE b1_b_id_team_1 LIKE '%".$_REQUEST['Grupa_1']."%' OR b1_b_id_team_2 LIKE '%".$_REQUEST['Grupa_1']."%' LIMIT 0, 1";
	$result = mysql_query($query) or die(mysql_error());
	
	while ($row = mysql_fetch_array($result)) {
		$b1_id = $row['b1_id'];
	}
	*/
	$query = "SELECT b_id FROM b_team WHERE b_group = '".$_REQUEST['Grupa_1']."' ORDER BY b_points DESC, b_goal_difference DESC, b_goals_for DESC LIMIT 0, 1";
	$result = mysql_query($query) or die(mysql_error());
	
	while ($row = mysql_fetch_array($result)) {
		$b_id = $row['b_id'];
	}

	$query = "UPDATE b1_match SET b1_b_id_team_1 = '".$b_id."' WHERE b1_b_id_team_1 = '".$_REQUEST['Grupa_1']."1'";
	$result = mysql_query($query) or die(mysql_error());
	/*
	$query = "SELECT b1_id FROM b1_match WHERE b1_b_id_team_1 LIKE '%".$_REQUEST['Grupa_1']."%' OR b1_b_id_team_2 LIKE '%".$_REQUEST['Grupa_1']."%' LIMIT 0, 1";
	$result = mysql_query($query) or die(mysql_error());
	
	while ($row = mysql_fetch_array($result)) {
		$b1_id = $row['b1_id'];
	}
	*/
	$query = "SELECT * FROM b_team WHERE b_group = '".$_REQUEST['Grupa_1']."' ORDER BY b_points DESC, b_goal_difference DESC, b_goals_for DESC LIMIT 1, 1";
	$result = mysql_query($query) or die(mysql_error());
	
	while ($row = mysql_fetch_array($result)) {
		$b_id = $row['b_id'];
	}	

	$query = "UPDATE b1_match SET b1_b_id_team_2 = '".$b_id."' WHERE b1_b_id_team_2 = '".$_REQUEST['Grupa_1']."2'";
	$result = mysql_query($query) or die(mysql_error());
	}
	
	} else if ($_REQUEST['Mecz'] >= 49 && $_REQUEST['Mecz'] <= 60) {
	
	if ($_POST['Wynik_1'] > $_POST['Wynik_2']) {
	
	$query = "UPDATE b1_match SET b1_b_id_team_1 = '".$_REQUEST['id_team_1']."' WHERE b1_b_id_team_1 LIKE '%".$_REQUEST['Mecz']."%'";
	$result = mysql_query($query) or die(mysql_error());
	
	$query = "UPDATE b1_match SET b1_b_id_team_2 = '".$_REQUEST['id_team_1']."' WHERE b1_b_id_team_2 LIKE '%".$_REQUEST['Mecz']."%'";
	$result = mysql_query($query) or die(mysql_error());
	} else {
	
	$query = "UPDATE b1_match SET b1_b_id_team_1 = '".$_REQUEST['id_team_2']."' WHERE b1_b_id_team_1 LIKE '%".$_REQUEST['Mecz']."%'";
	$result = mysql_query($query) or die(mysql_error());
	
	$query = "UPDATE b1_match SET b1_b_id_team_2 = '".$_REQUEST['id_team_2']."' WHERE b1_b_id_team_2 LIKE '%".$_REQUEST['Mecz']."%'";
	$result = mysql_query($query) or die(mysql_error());
	}
	
	} else if ($_REQUEST['Mecz'] == 61) {
	
	if ($_POST['Wynik_1'] > $_POST['Wynik_2']) {
	
	$query = "UPDATE b1_match SET b1_b_id_team_1 = '".$_REQUEST['id_team_1']."' WHERE b1_id = 64";
	$result = mysql_query($query) or die(mysql_error());
	
	$query = "UPDATE b1_match SET b1_b_id_team_1 = '".$_REQUEST['id_team_2']."' WHERE b1_id = 63";
	$result = mysql_query($query) or die(mysql_error());
	} else {
	$query = "UPDATE b1_match SET b1_b_id_team_1 = '".$_REQUEST['id_team_2']."' WHERE b1_id = 64";
	$result = mysql_query($query) or die(mysql_error());
	
	$query = "UPDATE b1_match SET b1_b_id_team_1 = '".$_REQUEST['id_team_1']."' WHERE b1_id = 63";
	$result = mysql_query($query) or die(mysql_error());
	
	}
	
	} else if ($_REQUEST['Mecz'] == 62) {
	
	if ($_POST['Wynik_1'] > $_POST['Wynik_2']) {
	
	$query = "UPDATE b1_match SET b1_b_id_team_2 = '".$_REQUEST['id_team_1']."' WHERE b1_id = 64";
	$result = mysql_query($query) or die(mysql_error());
	
	$query = "UPDATE b1_match SET b1_b_id_team_2 = '".$_REQUEST['id_team_2']."' WHERE b1_id = 63";
	$result = mysql_query($query) or die(mysql_error());

	} else {
	$query = "UPDATE b1_match SET b1_b_id_team_2 = '".$_REQUEST['id_team_2']."' WHERE b1_id = 64";
	$result = mysql_query($query) or die(mysql_error());
	
	$query = "UPDATE b1_match SET b1_b_id_team_2 = '".$_REQUEST['id_team_1']."' WHERE b1_id = 63";
	$result = mysql_query($query) or die(mysql_error());
	
	}
	
	} else if ($_REQUEST['Mecz'] == 64) {
	
	if ($_POST['Wynik_1'] > $_POST['Wynik_2']) {
	
	$query = "UPDATE b_team SET b_name = '".$_REQUEST['id_team_1']."' WHERE b_id = 33";
	$result = mysql_query($query) or die(mysql_error());
	
	} else {
	$query = "UPDATE b_team SET b_name = '".$_REQUEST['id_team_2']."' WHERE b_id = 33";
	$result = mysql_query($query) or die(mysql_error());
	
	}
	
	}
	//funkcja porównująca typ do wyniku meczu
	
	//określenie znaku liczby (różnica wyników danego meczu)
	$result = $result_1 - $result_2;
	
	function sign($number) {
		return ($number > 0) ? 1 : (($number < 0) ? -1 : 0 );
	}
	
	$query = "SELECT a2_id, a2_result_team_1, a2_result_team_2, a2_result_team_1 - a2_result_team_2 AS a2_result_team FROM a2_bets WHERE a2_b1_id = '".$match."'";
	$result = mysql_query($query) or die(mysql_error());
	while ($row = mysql_fetch_array($result)) {
		$a2_id = $row['a2_id'];
		$a2_result_team_1 = $row['a2_result_team_1'];
		$a2_result_team_2 = $row['a2_result_team_2'];
		$a2_result_team = $row['a2_result_team'];
		
		
		
		//określenie znaku liczby (różnica typów danego meczu)
				
		if (($result_1 == $a2_result_team_1) && ($result_2 == $a2_result_team_2)) {
			$query1 = "UPDATE a2_bets SET a2_points = a2_points+3, a2_status = 1 WHERE a2_id = '".$a2_id."'";
			$result1 = mysql_query($query1) or die(mysql_error());
			
			if ($match == 64) {
			//dodanie +10 punktów za wytypowanie prawidłowego faworyta
				
				$query4 = "SELECT b_name FROM b_team WHERE b_id = 33";
				$result4 = mysql_query($query4) or die(mysql_error());
				while ($row4 = mysql_fetch_array($result4)) {
					$b_name = $row4['b_name'];
				}
				
				$query5 = "SELECT a_id, a_favorite FROM a_users";
				$result5 = mysql_query($query5) or die(mysql_error());
				while ($row5 = mysql_fetch_array($result5)) {
					$a_id = $row5['a_id'];
					$a_favorite = $row5['a_favorite'];
					
				if ($a_favorite == $b_name) {
					$query6 = "UPDATE a2_bets SET a2_points = a2_points+10 WHERE a2_id = '".$a2_id."' AND a2_a_id = '".$a_id."'";
					$result6 = mysql_query($query6) or die(mysql_error());
				}
				}
				
			break;
			}
		
		//usprawnienie systemu przyznawania pkt. za mecz
		} else if ((($result_1 - $result_2) > 0) && (($a2_result_team_1 - $a2_result_team_2) > 0)) { //niestety trza to usunąć: (gmp_sign($result_1-$result_2) == gmp_sign($a2_result_team_1-$a2_result_team_2)
			$query2 = "UPDATE a2_bets SET a2_points = a2_points+1, a2_status = 1 WHERE a2_id = '".$a2_id."'";
			$result2 = mysql_query($query2) or die(mysql_error());
			
			if ($match == 64) {
			//dodanie +10 punktów za wytypowanie prawidłowego faworyta
				
				$query4 = "SELECT b_name FROM b_team WHERE b_id = 33";
				$result4 = mysql_query($query4) or die(mysql_error());
				while ($row4 = mysql_fetch_array($result4)) {
					$b_name = $row4['b_name'];
				}
				
				$query5 = "SELECT a_id, a_favorite FROM a_users";
				$result5 = mysql_query($query5) or die(mysql_error());
				while ($row5 = mysql_fetch_array($result5)) {
					$a_id = $row5['a_id'];
					$a_favorite = $row5['a_favorite'];
					
				if ($a_favorite == $b_name) {
					$query6 = "UPDATE a2_bets SET a2_points = a2_points+10 WHERE a2_id = '".$a2_id."' AND a2_a_id = '".$a_id."'";
					$result6 = mysql_query($query6) or die(mysql_error());
				}
				}
				
				
			}
		
		} else if ((($result_1 - $result_2) < 0) && (($a2_result_team_1 - $a2_result_team_2) < 0)) { //niestety trza to usunąć: (gmp_sign($result_1-$result_2) == gmp_sign($a2_result_team_1-$a2_result_team_2)
			$query2 = "UPDATE a2_bets SET a2_points = a2_points+1, a2_status = 1 WHERE a2_id = '".$a2_id."'";
			$result2 = mysql_query($query2) or die(mysql_error());
			
			if ($match == 64) {
			//dodanie +10 punktów za wytypowanie prawidłowego faworyta
				
				$query4 = "SELECT b_name FROM b_team WHERE b_id = 33";
				$result4 = mysql_query($query4) or die(mysql_error());
				while ($row4 = mysql_fetch_array($result4)) {
					$b_name = $row4['b_name'];
				}
				
				$query5 = "SELECT a_id, a_favorite FROM a_users";
				$result5 = mysql_query($query5) or die(mysql_error());
				while ($row5 = mysql_fetch_array($result5)) {
					$a_id = $row5['a_id'];
					$a_favorite = $row5['a_favorite'];
					
				if ($a_favorite == $b_name) {
					$query6 = "UPDATE a2_bets SET a2_points = a2_points+10 WHERE a2_id = '".$a2_id."' AND a2_a_id = '".$a_id."'";
					$result6 = mysql_query($query6) or die(mysql_error());
				}
				}
				
				
			}
		
		} else if ((($result_1 - $result_2) == 0) && (($a2_result_team_1 - $a2_result_team_2) == 0)) { //niestety trza to usunąć: (gmp_sign($result_1-$result_2) == gmp_sign($a2_result_team_1-$a2_result_team_2)
			$query2 = "UPDATE a2_bets SET a2_points = a2_points+1, a2_status = 1 WHERE a2_id = '".$a2_id."'";
			$result2 = mysql_query($query2) or die(mysql_error());
			
			if ($match == 64) {
			//dodanie +10 punktów za wytypowanie prawidłowego faworyta
				
				$query4 = "SELECT b_name FROM b_team WHERE b_id = 33";
				$result4 = mysql_query($query4) or die(mysql_error());
				while ($row4 = mysql_fetch_array($result4)) {
					$b_name = $row4['b_name'];
				}
				
				$query5 = "SELECT a_id, a_favorite FROM a_users";
				$result5 = mysql_query($query5) or die(mysql_error());
				while ($row5 = mysql_fetch_array($result5)) {
					$a_id = $row5['a_id'];
					$a_favorite = $row5['a_favorite'];
					
				if ($a_favorite == $b_name) {
					$query6 = "UPDATE a2_bets SET a2_points = a2_points+10 WHERE a2_id = '".$a2_id."' AND a2_a_id = '".$a_id."'";
					$result6 = mysql_query($query6) or die(mysql_error());
				}
				}
				
				
			}
		
		}
		/*
		else if (gmp_sign($result_1-$result_2)) != gmp_sign($a2_result_team_1-$a2_result_team_2)) {
			$query3 = "UPDATE a2_bets SET a2_points = a2_points+1, a2_status = 1 WHERE a2_id = '".$a2_id."'";
			$result3 = mysql_query($query3) or die(mysql_error());
			
			if ($match == 64) {
			//dodanie +10 punktów za wytypowanie prawidłowego faworyta
				
				$query4 = "SELECT b_name FROM b_team WHERE b_id = 33";
				$result4 = mysql_query($query4) or die(mysql_error());
				while ($row4 = mysql_fetch_array($result4)) {
					$b_name = $row4['b_name'];
				}
				
				$query5 = "SELECT a_id, a_favorite FROM a_users";
				$result5 = mysql_query($query5) or die(mysql_error());
				while ($row5 = mysql_fetch_array($result5)) {
					$a_id = $row5['a_id'];
					$a_favorite = $row5['a_favorite'];
					
				if ($a_favorite == $b_name) {
					$query6 = "UPDATE a2_bets SET a2_points = a2_points+10 WHERE a2_id = '".$a2_id."' AND a2_a_id = '".$a_id."'";
					$result6 = mysql_query($query6) or die(mysql_error());
				}
				}
				
				
			}
		
		} 
		*/
		else if ($match == 64) {
		//dodanie +10 punktów za wytypowanie prawidłowego faworyta
			
			$query4 = "SELECT b_name FROM b_team WHERE b_id = 33";
			$result4 = mysql_query($query4) or die(mysql_error());
			while ($row4 = mysql_fetch_array($result4)) {
				$b_name = $row4['b_name'];
			}
			
			$query5 = "SELECT a_id, a_favorite FROM a_users";
			$result5 = mysql_query($query5) or die(mysql_error());
			while ($row5 = mysql_fetch_array($result5)) {
				$a_id = $row5['a_id'];
				$a_favorite = $row5['a_favorite'];
				
			if ($a_favorite == $b_name) {
				$query6 = "UPDATE a2_bets SET a2_points = a2_points+10 WHERE a2_id = '".$a2_id."' AND a2_a_id = '".$a_id."'";
				$result6 = mysql_query($query6) or die(mysql_error());
			}
			}
			
			
		} else {
			$query7 = "UPDATE a2_bets SET a2_status = 1 WHERE a2_id = '".$a2_id."'";
			$result7 = mysql_query($query7) or die(mysql_error());
			
			if ($match == 64) {
			//dodanie +10 punktów za wytypowanie prawidłowego faworyta
				
				$query8 = "SELECT b_name FROM b_team WHERE b_id = 33";
				$result8 = mysql_query($query8) or die(mysql_error());
				while ($row8 = mysql_fetch_array($result8)) {
					$b_name = $row8['b_name'];
				}
				
				$query9 = "SELECT a_id, a_favorite FROM a_users";
				$result9 = mysql_query($query9) or die(mysql_error());
				while ($row9 = mysql_fetch_array($result5)) {
					$a_id = $row9['a_id'];
					$a_favorite = $row9['a_favorite'];
					
				if ($a_favorite == $b_name) {
					$query10 = "UPDATE a2_bets SET a2_points = a2_points+10 WHERE a2_id = '".$a2_id."' AND a2_a_id = '".$a_id."'";
					$result10 = mysql_query($query10) or die(mysql_error());
				}
				}
				
				
			}
		
		
		}
	}

	header("Location: ../../match-result.php", TRUE, 303);
}
?>