<?php
$query = "SELECT a_id, a_fname FROM a_users WHERE a_mail = '" . $_SESSION['user_logged'] . "'";
$result = mysql_query($query) or die(mysql_error());

while ($row = mysql_fetch_array($result)) {
	$a_id = $row['a_id'];
	$a_fname = $row['a_fname'];
}

$query = "SELECT b_name, b_flag FROM b_team ORDER BY b_name ASC";
$result = mysql_query($query) or die(mysql_error());

while ($row = mysql_fetch_array($result)) {
	$b_name = $row['b_name'];
	$b_flag = $row['b_flag'];
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
                    
                    <li><a href="#" class="hidden-phone visible-tablet visible-desktop" role="button" onclick="rules()"><i class="icon-bullhorn"></i> Zasady</a></li>
					
					<li id="fat-menu" class="dropdown">
                        <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-star"></i> Mój faworyt
                            <i class="icon-caret-down"></i>
                        </a>
					<ul class="dropdown-menu">
EOD;

$navbar_dynamic = '';
$query = "SELECT b_name, b_flag FROM b_team";
$result = mysql_query($query) or die(mysql_error());

while ($row = mysql_fetch_array($result)) {
	$b_name = $row['b_name'];
	$b_flag = $row['b_flag'];
	
	$navbar_dynamic .=<<<EOD

    <li><a tabindex="-1" href="#"><img src="../../images/flags/$b_flag"> $b_name</a></li>
    
EOD;
}

$navbar_footer =<<<EOD
                        </ul>
                    </li>
					
                    <li id="fat-menu" class="dropdown">
                        <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-user"></i> $a_fname
                            <i class="icon-caret-down"></i>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a tabindex="-1" href="#">Moje konto</a></li>
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