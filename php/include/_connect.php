<?php

include("/var/www/html/env.php");

$connect = mysqli_connect($db_host, $db_user, $db_password, $db_name);

if (mysqli_connect_errno()) echo("Connect failed: %s\n" . mysqli_connect_error());
