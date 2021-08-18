<?php
$dbhost = 'remotemysql.com:3306';
         $dbuser = getenv(dbuser);
         $dbpass = getenv(dbpass);
         $pdo = new mysqli($dbhost, $dbuser, $dbpass);
?>
