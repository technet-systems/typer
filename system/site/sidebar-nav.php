<?php
if($_SESSION['user_level'] == 2) {
$sidebarnav = '

<script>

</script>

	<div class="sidebar-nav">

        <a href="#dashboard-menu" class="nav-header" data-toggle="collapse"><i class="icon-dashboard"></i>Panel Typera</a>
        <ul id="dashboard-menu" class="nav nav-list collapse in">
            <li class="active"><a href="start.php">Start</a></li>
            <li ><a href="matches.php">Więcej meczy</a></li>
            <li ><a href="bets.php">Wiecej typów</a></li>
            <li ><a href="history.php">Historia typowań</a></li>
            <li ><a href="user.php">Moje konto</a></li>
            
        </ul>

        <a href="#accounts-menu" class="nav-header" data-toggle="collapse"><i class="icon-briefcase"></i>Admin<span class="label label-info">+3</span></a>
        <ul id="accounts-menu" class="nav nav-list collapse">
            <li ><a href="match-result.php">Wyniki meczów</a></li>
            <li ><a href="sign-up.html">Faza grupowa</a></li>
        </ul>
		<!-- usunięte
        <a href="#error-menu" class="nav-header collapsed" data-toggle="collapse"><i class="icon-exclamation-sign"></i>Error Pages <i class="icon-chevron-up"></i></a>
        <ul id="error-menu" class="nav nav-list collapse">
            <li ><a href="403.html">403 page</a></li>
            <li ><a href="404.html">404 page</a></li>
            <li ><a href="500.html">500 page</a></li>
            <li ><a href="503.html">503 page</a></li>
        </ul>

        <a href="#legal-menu" class="nav-header" data-toggle="collapse"><i class="icon-legal"></i>Legal</a>
        <ul id="legal-menu" class="nav nav-list collapse">
            <li ><a href="privacy-policy.html">Privacy Policy</a></li>
            <li ><a href="terms-and-conditions.html">Terms and Conditions</a></li>
        </ul>

        <a href="help.html" class="nav-header" ><i class="icon-question-sign"></i>Help</a>
        <a href="faq.html" class="nav-header" ><i class="icon-comment"></i>Faq</a>
		-->
    </div>

';
} else {
$sidebarnav = '

<script>

</script>

	<div class="sidebar-nav">

        <a href="#dashboard-menu" class="nav-header" data-toggle="collapse"><i class="icon-dashboard"></i>Panel Typera</a>
        <ul id="dashboard-menu" class="nav nav-list collapse in">
            <li class="active"><a href="start.php">Start</a></li>
            <li ><a href="matches.php">Więcej meczy</a></li>
            <li ><a href="bets.php">Wiecej typów</a></li>
            <li ><a href="history.php">Historia typowań</a></li>
            <li ><a href="user.php">Moje konto</a></li>
            
        </ul>
    </div>

';

}
?>