<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'modelhig_user';
$DATABASE_PASS = '^~EPo+TQON;y';
$DATABASE_NAME = 'modelhig_DB';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (mysqli_connect_errno()) {
  exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

?>