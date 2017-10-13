<?php
$result_1 = 1;
$result_2 = 1;
$result = $result_1 - $result_2;

$a2_result_team_1 = 2;
$a2_result_team_2 = 2;

function sign($number) {
    return ($number > 0) ? 1 : (($number < 0) ? -1 : 0);
}

$a2_result_team = $a2_result_team_1 - $a2_result_team_2;



echo sign( $result ); // Return 1
echo sign( $a2_result_team ); // Return -1

if(($result_1 == $a2_result_team_1) && ($result_2 == $a2_result_team_2)) {
	print "masz 3 punkty";
} else if(sign($result) == sign($a2_result_team)) {
	print "masz 1 punkt";
} else {
	print "masz 0 punktow";
}

?>