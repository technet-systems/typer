<?php
session_start();
session_destroy();
header ("Location: http://apps.technet.systems/typer/index.html", TRUE, 303);
?> 