<?php
include "system/connect.php";
include "system/login/check-user.php";
include "system/site/navbar.php";
include "system/site/sidebar-nav.php";
include "system/site/header.php";
include "system/features/change-send.php"
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
            <li class="active">Moje konto</li>
        </ul>

        <div class="container-fluid">
            <div class="row-fluid">
                    
<div class="well">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#home" data-toggle="tab">Profil</a></li>
      <li><a href="#profile" data-toggle="tab">Hasło</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
    <form id="tab" action="system/features/change-send.php" method="POST">
	<!-- usunięte
        <label>Username</label>
        <input type="text" value="jsmith" class="span1">
        <label>First Name</label>
        <input type="text" value="John" class="input-xlarge">
        <label>Last Name</label>
        <input type="text" value="Smith" class="input-xlarge">
        <label>Email</label>
        <input type="text" value="jsmith@yourcompany.com" class="input-xlarge">
	-->
		<label>Wysyłka maili:</label>
		<?php print $send; ?>
    <!-- usunięte    
		<label>Address</label>
        <textarea value="Smith" rows="3" class="input-xlarge">
2817 S 49th
Apt 314
San Jose, CA 95101
        </textarea>
        <label>Time Zone</label>
        <select name="DropDownTimezone" id="DropDownTimezone" class="input-xlarge">
          <option value="-12.0">(GMT -12:00) Eniwetok, Kwajalein</option>
          <option value="-11.0">(GMT -11:00) Midway Island, Samoa</option>
          <option value="-10.0">(GMT -10:00) Hawaii</option>
          <option value="-9.0">(GMT -9:00) Alaska</option>
          <option selected="selected" value="-8.0">(GMT -8:00) Pacific Time (US &amp; Canada)</option>
          <option value="-7.0">(GMT -7:00) Mountain Time (US &amp; Canada)</option>
          <option value="-6.0">(GMT -6:00) Central Time (US &amp; Canada), Mexico City</option>
          <option value="-5.0">(GMT -5:00) Eastern Time (US &amp; Canada), Bogota, Lima</option>
          <option value="-4.0">(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz</option>
          <option value="-3.5">(GMT -3:30) Newfoundland</option>
          <option value="-3.0">(GMT -3:00) Brazil, Buenos Aires, Georgetown</option>
          <option value="-2.0">(GMT -2:00) Mid-Atlantic</option>
          <option value="-1.0">(GMT -1:00 hour) Azores, Cape Verde Islands</option>
          <option value="0.0">(GMT) Western Europe Time, London, Lisbon, Casablanca</option>
          <option value="1.0">(GMT +1:00 hour) Brussels, Copenhagen, Madrid, Paris</option>
          <option value="2.0">(GMT +2:00) Kaliningrad, South Africa</option>
          <option value="3.0">(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg</option>
          <option value="3.5">(GMT +3:30) Tehran</option>
          <option value="4.0">(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi</option>
          <option value="4.5">(GMT +4:30) Kabul</option>
          <option value="5.0">(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent</option>
          <option value="5.5">(GMT +5:30) Bombay, Calcutta, Madras, New Delhi</option>
          <option value="5.75">(GMT +5:45) Kathmandu</option>
          <option value="6.0">(GMT +6:00) Almaty, Dhaka, Colombo</option>
          <option value="7.0">(GMT +7:00) Bangkok, Hanoi, Jakarta</option>
          <option value="8.0">(GMT +8:00) Beijing, Perth, Singapore, Hong Kong</option>
          <option value="9.0">(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk</option>
          <option value="9.5">(GMT +9:30) Adelaide, Darwin</option>
          <option value="10.0">(GMT +10:00) Eastern Australia, Guam, Vladivostok</option>
          <option value="11.0">(GMT +11:00) Magadan, Solomon Islands, New Caledonia</option>
          <option value="12.0">(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka</option>
    </select>
	-->
	<div class="btn-toolbar">
	<input type="submit" name="submit" value="Zapisz" class="btn btn-primary pull-left">
  <div class="btn-group">
  </div>
</div>
	
    </form>
      </div>
      <div class="tab-pane fade" id="profile">
    <form id="tab2" action="system/features/change-pass.php" method="POST">
        <label>Nowe hasło:</label>
        <input type="password" name="pass" class="input-xlarge">
        <div>
			<input type="submit" name="submit" value="Zapisz" class="btn btn-primary pull-left">
        </div>
    </form>
      </div>
  </div>

</div>

<div class="modal small hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Podaj swój typ</h3>
  </div>
  <div class="modal-body">
    

	<table class="table list">
      <tbody>
        <tr>
          <td class="right_align">Niemcy <img src="images/flags/Germany.svg.png"></td>
		  <td class="center_align">
		  <input type="text" name="" maxlength="2" size="2" class="span3"> - 
		  <input type="text" name="" maxlength="2" size="4" class="span3">
		  </td>
          <td><img src="images/flags/Cote_Ivoire.svg.png"> WKS</td>
        </tr>
      </tbody>
    </table>
	
	

  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Anuluj</button>
    <button class="btn btn-danger" data-dismiss="modal">Typuj</button>
  </div>
</div>


                    
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


