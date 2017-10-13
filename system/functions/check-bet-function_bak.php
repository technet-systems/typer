<?php
function check_bet($result_1, $result_2, $match) {
	
	$query = "SELECT a2_id, a2_result_team_1, a2_result_team_2 FROM a2_bets WHERE a2_b1_id = '".$match."'";
	$result = mysql_query($query) or die(mysql_error());
	while ($row = mysql_fetch_array($result)) {
		$a2_id = $row['a2_id'];
		$a2_result_team_1 = $row['a2_result_team_1'];
		$a2_result_team_2 = $row['a2_result_team_2'];
		
		if ($result_1 == $a2_result_team_1 && $result_2 == $a2_result_team_2) {
			$query1 = "UPDATE a2_bets SET a2_points = a2_points+3, a2_status = 1 WHERE a2_id = '".$a2_id."'";
			$result1 = mysql_query($query1) or die(mysql_error());
			
			if ($match == 64) {
			//dodanie +10 punkt闚 za wytypowanie prawid這wego faworyta
				
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
		//(gmp_sign($result_1-$result_2)) == gmp_sign($a2_result_team_1-$a2_result_team_2))
		} else if (($result_1-$result_2) <= 0 && ($a2_result_team_1-$a2_result_team_2) <= 0) { //tu jest BㄔD!!!
			$query2 = "UPDATE a2_bets SET a2_points = a2_points+1, a2_status = 1 WHERE a2_id = '".$a2_id."'";
			$result2 = mysql_query($query2) or die(mysql_error());
			
			if ($match == 64) {
			//dodanie +10 punkt闚 za wytypowanie prawid這wego faworyta
				
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
		
		} else if (($result_1-$result_2) > 0 && ($a2_result_team_1-$a2_result_team_2) > 0) {
			$query3 = "UPDATE a2_bets SET a2_points = a2_points+1, a2_status = 1 WHERE a2_id = '".$a2_id."'";
			$result3 = mysql_query($query3) or die(mysql_error());
			
			if ($match == 64) {
			//dodanie +10 punkt闚 za wytypowanie prawid這wego faworyta
				
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
		
		} else if (($result_1-$result_2) != ($a2_result_team_1-$a2_result_team_2)) {
			$query7 = "UPDATE a2_bets SET a2_status = 1 WHERE a2_id = '".$a2_id."'";
			$result7 = mysql_query($query7) or die(mysql_error());
			
			if ($match == 64) {
			//dodanie +10 punkt闚 za wytypowanie prawid這wego faworyta
				
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
		
		
		} else if ($match == 64) {
		//dodanie +10 punkt闚 za wytypowanie prawid這wego faworyta
			
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
}
?>