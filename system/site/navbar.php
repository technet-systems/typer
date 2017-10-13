<?php
$today = date("Y-m-d H:i:s");

$query = "SELECT a_id, a_mail FROM a_users WHERE a_mail = '" . $_SESSION['user_logged'] . "'";
$result = mysql_query($query) or die(mysql_error());

while ($row = mysql_fetch_array($result)) {
	$a_id = $row['a_id'];
	$a_mail = $row['a_mail'];
	list($a_nick_mail) = explode("@", $a_mail);
}

$query = "SELECT b_name, b_flag FROM b_team ORDER BY b_name ASC";
$result = mysql_query($query) or die(mysql_error());

while ($row = mysql_fetch_array($result)) {
	$b_name = $row['b_name'];
	$b_flag = $row['b_flag'];
}

$query = "SELECT count(b1_id), b1_datetime FROM b1_match WHERE b1_status = 0 LIMIT 0, 1";
$result = mysql_query($query) or die(mysql_error());

while ($row = mysql_fetch_array($result)) {
	$b1_datetime = $row['b1_datetime'];
	$b1_id = $row['count(b1_id)'];
}

$query = "SELECT MAX(b1_timestamp) FROM b1_match WHERE b1_status = 1";
$result = mysql_query($query) or die(mysql_error());

while ($row = mysql_fetch_array($result)) {
	$b1_timestamp = $row['MAX(b1_timestamp)'];
}

$navbar_header =<<<EOD

<script>
function rules()
{
alert("1. Typujemy konkretny wynik meczu\n\n2. Za prawidłowy typ otrzymujemy 3 punkty\n\n3. Za wskazanie wygranej drużyny bądź remisu 1 pkt\n\n4. Za wskazanie faworyta turnieju otrzymujemy po zakończeniu rozgrywek 10 punktów");
}
</script>

<div class="navbar">
        <div class="navbar-inner">
                <ul class="nav pull-right">
                    
                    <li id="fat-menu" class="dropdown">
                        <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-bullhorn"></i> Zasady
                            <i class="icon-caret-down"></i>
                        </a>
					<ul class="dropdown-menu">
						<li><a tabindex="-1" href="#">1. Typujesz <b>końcowe wyniki</b> spotkań</a></li>
						<li class="divider"></li>
						<li><a tabindex="-1" href="#">2. Za wytypowanie dokładnego wyniku otrzymujesz <b>3 pkt.</b></a></li>
						<li class="divider"></li>
						<li><a tabindex="-1" href="#">3. Za wytypowanie zwycięzcy bądź remisu otrzymujesz <b>1 pkt.</b></a></li>
						<li class="divider"></li>
						<li><a tabindex="-1" href="#">4. Za prawidłowe wskazanie faworyta, który wygra turniej otrzymujesz <b>10 pkt.</b></a></li>
						
					</ul>
					</li>
					
					<li id="fat-menu" class="dropdown">
                        <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-star"></i> Faworyt
                            <i class="icon-caret-down"></i>
                        </a>
					<ul class="dropdown-menu">
EOD;

$navbar_dynamic = '';
$query = "SELECT b_id, b_name, b_flag FROM b_team LIMIT 0, 32";
$result = mysql_query($query) or die(mysql_error());

if (3 > 4) { //wykasowany test logiczny: $today > $b1_datetime

while ($row = mysql_fetch_array($result)) {
	$b_id = $row['b_id'];
	$b_name = $row['b_name'];
	$b_flag = $row['b_flag'];
	
	$navbar_dynamic .=<<<EOD

    <li><a tabindex="-1" href="../../system/features/change-favorite.php?b_id=$b_id&a_id=$a_id"><img src="../../images/flags/$b_flag"> $b_name</a></li>
    
EOD;
}
} else {

	$navbar_dynamic .=<<<EOD

    <li><a tabindex="-1" href="#"><img src="../../images/flags/None.svg.png"> Nibylandia</a></li>
	
EOD;
}


$navbar_footer =<<<EOD
                        </ul>
                    </li>
					
                    <li id="fat-menu" class="dropdown">
                        <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-user"></i> $a_nick_mail
                            <i class="icon-caret-down"></i>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a tabindex="-1" href="user.php">Moje konto</a></li>
                            <li class="divider"></li>
                            <li><a tabindex="-1" class="visible-phone" href="#">Zasady</a></li>
                            <li class="divider visible-phone"></li>
                            <li><a tabindex="-1" href="../../system/login/logout.php">Wyloguj</a></li>
                        </ul>
                    </li>
                    
                </ul>
                <a class="brand" href="start.php"><span class="first"><img src="../../images/logo/typer.png" class="logo" width="67" height="20"> 1.0</span> <span class="second">MŚ Brazylia 2014</span></a>
        </div>
    </div>
EOD;

$navbar =<<<COMPLETE
	$navbar_header
	$navbar_dynamic
	$navbar_footer
COMPLETE;
?>