<?php
include "../../system/connect.php";
include "../../system/login/add-user.php";
?>

<!DOCTYPE html>
<html lang="pl">
  <head>
	<meta name="robots" content="noindex, nofollow">
    <meta charset="utf-8">
    <title>Typer 1.0 - MŚ Brazylia 2014</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" type="text/css" href="../../lib/bootstrap/css/bootstrap.css">
    
    <link rel="stylesheet" type="text/css" href="../../stylesheets/theme.css">
    <link rel="stylesheet" href="../../lib/font-awesome/css/font-awesome.css">

    <script src="../../lib/jquery-1.7.2.min.js" type="text/javascript"></script>

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
    
    <div class="navbar">
        <div class="navbar-inner">
                <ul class="nav pull-right">
                    
                </ul>
                <a class="brand" href="index.html"><span class="first"><img src="../../images/logo/typer.png" class="logo" width="67" height="20"> 1.0</span> <span class="second">MŚ Brazylia 2014</span></a>
        </div>
    </div>
    


    

    
        <div class="row-fluid">
    <div class="dialog">
        <div class="block">
            <p class="block-heading">Weryfikacja</p>
            <div class="block-body">
                <form action="../../system/login/verify-process.php" method="post">
                    <label>Kod:</label>
                    <input type="text" class="span12" placeholder="Podaj 10-cio cyfrowy kod otrzymany e-mailem" name="a_temp_pass" pattern="[0-9]{10}" required>
                    <input type="submit" name="submit" value="Weryfikuj!" class="btn btn-primary pull-right">
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
        <p class="pull-right" style=""><a href="http://www.portnine.com" target="blank">Theme by Portnine</a> powered by: <a href="http://www.scena.net.pl" target="blank">scena.net.pl</a></p>
		<p><a href="../../index.html">Logowanie!</a></p>
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

