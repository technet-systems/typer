<?php
/* Lightowe operacje na datach - może się przydać :)
$today = date("Y-m-d H:i:s", time()+86400);
$match_date = date("Y-m-d-H-i-s", strtotime("$today +1 year"));
list($year, $month, $day, $hour, $minute, $second) = explode("-", $match_date);
*/

//wyciągnięcie daty pierwszego meczu z BD jest w navbar.php

// rozbicie formatu YYYY-MM-DD HH:MM:SS na czynniki pierwsze ;)
list($date, $time) = explode(" ", $b1_datetime);
list($year, $month, $day) = explode("-", $date);
list($hour, $minute, $second) = explode(":", $time);
//odjęcie od miesiąca 1 wartości, bo JS liczy miesiące od 0, czyli 0->styczeń, 1->luty, itd.
$month_alternate = $month - 1;

$query = "SELECT b_id, b_name, b_flag FROM b_team, a_users WHERE a_mail = '" . $_SESSION['user_logged'] . "' AND a_favorite = b_id";
$result = mysql_query($query) or die(mysql_error());
while ($row = mysql_fetch_array($result)) {
	$b_id = $row['b_id'];
	$b_name = $row['b_name'];
	$b_flag = $row['b_flag'];
}

$header = '

<!-- link: http://videokurs.pl/artykuly/javascript/odliczanie-czasu-do-zdarzenia.php -->
<script>
function czasDoWydarzenia(rok, miesiac, dzien, godzina, minuta, sekunda, milisekunda)
{
	var aktualnyCzas = new Date();
	var dataWydarzenia = new Date(rok, miesiac, dzien, godzina, minuta, sekunda, milisekunda);
	var pozostalyCzas = dataWydarzenia.getTime() - aktualnyCzas.getTime();
	
	if (pozostalyCzas > 0)
	{						
		var s = pozostalyCzas / 1000;		// sekundy
		var min = s / 60;					// minuty
		var h = min / 60;					// godziny
		var d = h / 24;						// dni (dodane)
		
		var sLeft = Math.floor(s  % 60);	// pozostało sekund		
		var minLeft = Math.floor(min % 60);	// pozostało minut
		var hLeft = Math.floor(min % 24);	// pozostało godzin
		var dLeft = Math.floor(d);			// pozostało dni (dodane)
				
		if (minLeft < 10)
		  minLeft = "0" + minLeft;
		if (sLeft < 10)
		  sLeft = "0" + sLeft;
		
		return dLeft + " dn. " + hLeft + " godz. " + minLeft + " min. " + sLeft + " s.";
	}
	else
		return "Obliczam czas do najbliższego meczu...";
}
					
window.onload = function()
{
	idElement = "over-time";
	document.getElementById(idElement).innerHTML = czasDoWydarzenia(2010, 11, 20, 20, 0, 0, 0);
	setInterval("document.getElementById(idElement).innerHTML = czasDoWydarzenia('.$year.', '.$month_alternate.', '.$day.', '.$hour.', '.$minute.', '.$second.', 0)", 1000);
};
</script>
<!-- koniec linku -->

	<div class="header">
        <div class="stats">
			<p class="stat">Aktualizacja: <span class="number">'.$b1_timestamp.'</span></p>
			<p class="stat">Mój faworyt: <span class="number"><img src="../../images/flags/'.$b_flag.'"> '.$b_name.'</span></p>
			<!-- usunięte
			<p class="stat">Mieszek: <span class="number">250</span></p>
			-->
			<p class="stat">Pozostałe mecze: <span class="number">'.$b1_id.'</span></p>
			<p class="stat">Najbliższy mecz: <span class="number" id="over-time"></span></p>
		</div>

        <h1 class="page-title">Panel Typera</h1>
    </div>

';
?>