<?php

$username = "ws328700_lilith_internal";
$password = "#33tp9rP9xd_w1J662";
$db_name = "ws328700_internal";
$server = "plesk.remote.ac";

$connect = mysqli_connect($server, $username, $password, $db_name);


if (mysqli_connect_errno()) echo("Connect failed: %s\n" . mysqli_connect_error());