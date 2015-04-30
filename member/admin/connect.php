<?php

ob_start();

//session
session_start();
require_once __DIR__ . '/libs/config.php';

//connect to database
$cxn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD,DB_DATABASE);
if (mysqli_connect_errno())
{echo "Failed to connect to MySQL: " . mysqli_connect_error();
die();
}
?>
