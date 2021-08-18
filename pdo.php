<?php
$dbhost = 'remotemysql.com:3306';
         $dbuser = getenv(dbuser);
         $dbpass = getenv(dbpass);
         $pdo = mysqli_connect($dbhost, $dbuser, $dbpass);
?>
