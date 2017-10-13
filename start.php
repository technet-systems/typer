<?php
include "system/connect.php";
include "system/login/check-user.php";
include "system/site/navbar.php";
include "system/site/sidebar-nav.php";
include "system/site/header.php";
include "system/features/change-bet.php";
?>

<!DOCTYPE html>
<html lang="pl">
  <head>
	<meta name="robots" content="noindex, nofollow">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <meta charset="utf-8">
    <title>Typer 1.0 - MŚ Brazylia 2014</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.css">
    
    <link rel="stylesheet" type="text/css" href="stylesheets/theme.css">
    <link rel="stylesheet" href="lib/font-awesome/css/font-awesome.css">

    <script src="lib/jquery-1.7.2.min.js" type="text/javascript"></script>
	
    <!-- Demo page code -->

    <style type="text/css">
        #line-chart {
            height:300px;
            width:800px;
            margin: 0px auto;
            margin-top: 1em;
        }
        .brand { font-family: georgia, serif; }
        .brand .first {
            color: #ccc;
            font-style: italic;
        }
        .brand .second {
            color: #fff;
            font-weight: bold;
        }
    </style>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
  </head>

  <!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
  <!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
  <!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
  <!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
  <!--[if (gt IE 9)|!(IE)]><!--> 
  <body class=""> 
  <!--<![endif]-->
    
<?php
print $navbar;
print $sidebarnav;
?>

    <div class="content">
        
<?php
print $header;
?>
        
        <ul class="breadcrumb">
            <li><a href="start.php">Home</a> <span class="divider">/</span></li>
            <li class="active">Panel główny</li>
        </ul>

        <div class="container-fluid">
            <div class="row-fluid">
                    

<div class="row-fluid">
<?php
if ($b_id > 32 && $today < $b1_datetime) {
	print '
		<div class="alert alert-info">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<strong>UWAGA!!!</strong> Pamiętaj o wyborze faworyta - masz czas do rozpoczęcia pierwszego meczu! :)
		</div>
	';
}    
?>
	<div class="block">
        <a href="#page-stats" class="block-heading" data-toggle="collapse">Kursy typerów</a>
        <div id="page-stats" class="block-body collapse in">
		<table class="table">
		<thead>
        <tr>
          <th class="left_align">Mecz</th>
          <th class="right_align">Zespół 1</th>
		  <th>Kurs</th>
          <th class="left_align">Zespół 2</th>
		  <th>Typów</th>
          <th style="width: 26px;"></th>
        </tr>
      </thead>
		<tbody>
            <?php print $bets; ?>
		</tbody>
		</table>
        </div>
    </div>
	
</div>

<div class="row-fluid">
    <div class="block span6">
        <a href="#tablewidget" class="block-heading" data-toggle="collapse">Najbliższe mecze<span class="label label-warning"><b>Ilość pozostałych meczy: <?php print $b1_id; ?></b></span></a>
        <div id="tablewidget" class="block-body collapse in">
            <table class="table">
      <thead>
        <tr>
          <th class="left_align">#</th>
          <th class="left_align">Data i czas</th>
          <th class="right_align">Zespół 1</th>
		  <th>Wynik</th>
          <th class="left_align">Zespół 2</th>
		  <th>Typuj</th>
          <th style="width: 26px;"></th>
        </tr>
      </thead>
      <tbody>
        <?php
		print $new_bets;
		?>
      </tbody>
    </table>
	<?php
	if(!isset($_REQUEST['more-matches'])) {
        print '<p><a href="start.php?more-matches=4">Więcej meczy...</a></p>';
	} else {
		print '<p><a href="start.php">Mniej meczy...</a></p>';
	}
	?>
        </div>
    </div>
    <div class="block span6">
        <a href="#widget1container" class="block-heading" data-toggle="collapse">Moje typy</a>
        <div id="widget1container" class="block-body collapse in">
            <table class="table">
      <thead>
        <tr>
          <th class="left_align">#</th>
          <th class="left_align">Data i czas</th>
          <th class="right_align">Zespół 1</th>
		  <th>Typ</th>
          <th class="left_align">Zespół 2</th>
		  <th>Zmiana</th>
          <th style="width: 26px;"></th>
        </tr>
      </thead>
      <tbody>
        <?php
		print $my_bets;
		?>
      </tbody>
    </table>
    <?php
	if(!isset($_REQUEST['more-bets'])) {
        print '<p><a href="start.php?more-bets=4">Więcej typów...</a></p>';
	} else {
		print '<p><a href="start.php">Mniej typów...</a></p>';
	}
	?>
        </div>
    </div>
</div>

<div class="row-fluid">
    <div class="block span6">
        <div class="block-heading">
            <span class="block-icon pull-right">
                <a href="#" class="demo-cancel-click" rel="tooltip" title="Kliknij by rozwinąć"><i class="icon-refresh"></i></a>
            </span>

            <a href="#widget2container" data-toggle="collapse">Liga Typerów</a>
        </div>
        <div id="widget2container" class="block-body collapse">
            <table class="table">
			  <thead>
				<tr>
				  <th class="center_align">Typer</th>
				  <th class="center_align">Typowań</th>
				  <th class="center_align">Punkty</th>
				  <th class="center_align">Faworyt</th>
				</tr>
			  </thead>
              <tbody>
                <?php print $league; ?>
              </tbody>
            </table>
			<p><a href="users.html">Więcej ligi...</a></p>
        </div>
    </div>
    <div class="block span6">
        <p class="block-heading">Historia moich typowań <span class="label label-warning">Twoja skuteczność: <b><?php print $efficacy; ?>%</b></span></p>
        <div class="block-body">
            <table class="table">
      <thead>
        <tr>
          <th class="left_align">#</th>
          <th class="left_align">Data i czas</th>
          <th class="right_align">Zespół 1</th>
		  <th>Wynik</th>
          <th class="left_align">Zespół 2</th>
		  <th>Rezultat</th>
          <th style="width: 26px;"></th>
        </tr>
      </thead>
      <tbody>
        <?php print $history_bets; ?>
      </tbody>
    </table>
    <?php
	if(!isset($_REQUEST['more-history'])) {
        print '<p><a href="start.php?more-history=4">Więcej historii...</a></p>';
	} else {
		print '<p><a href="start.php">Mniej historii...</a></p>';
	}
	?>
            <p><a class="btn btn-primary btn-large">Learn more &raquo;</a></p>
        </div>
    </div>
</div>

<!-- zlatujące okienko typerskie :) -->
<?php
print $new_bets_window;
print $change_bets_window;
?>
<!-- koniec okienka typerskiego -->

                    
                    <footer>
                        <hr>
                        <!-- Purchase a site license to remove this link from the footer: http://www.portnine.com/bootstrap-themes -->
                        <p class="pull-right">A <a href="http://www.portnine.com/bootstrap-themes" target="_blank">Free Bootstrap Theme</a> by <a href="http://www.portnine.com" target="_blank">Portnine</a></p>
                        

                        <p>&copy; 2012 <a href="http://www.portnine.com" target="_blank">Portnine</a></p>
                    </footer>
                    
            </div>
        </div>
    </div>
    


    <script src="lib/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>
    
  </body>
</html>


