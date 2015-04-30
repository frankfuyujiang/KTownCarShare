<?php
/*
 * Database Connection info
 */

// Define Database Connection
define('DB_HOST', 'localhost');
define('DB_USER','jenny1994');
define('DB_PWD','815815');
define('DB_DBNAME','K-Town Car Share');

// Using MySQL
$cxn = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_DBNAME);

// Check MySQL Connection
if (mysqli_connect_errno()){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
  die();
}

?>