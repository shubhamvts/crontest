<?php
$dbhost = 'remotemysql.com:3306';
         $dbuser = getenv(dbuser);
         $dbpass = getenv(dbpass);
         $dbname=getenv(dbname);
         $pdo = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
?>
