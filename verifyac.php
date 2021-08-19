<?php
require_once 'config.php';
if(! isset($_GET['name']) || ! isset($_GET['id'])) die('unauthorized access');
require_once 'config.php';
require 'vendor/autoload.php';
$mail=$_GET['name'];
$pw2=$_GET['id'];
$stmt=$pdo->prepare('INSERT INTO users (name,password,subscription) VALUES (:name,:pass,:val)');
$stmt->execute(array(
    ':name'=>$mail,
    ':pass'=>$pw2,
    ':val'=> 'yes' ));
?>

<html>
    <head>
    <style>
  .cntr{
    text-align: center;
    position: relative;
    top: 30%;
    transform: translateY();
  }
  </style>
    </head>
    <body>
        <div class="cntr">
            <p> <h1 style="color:green"> ACCOUNT SUCCESSFULLY VERIFIED </h1> </p>
        <p> <span style="color:red"> You are successfully subscribed to our Comics Subsciption. You will shortly start receiving emails with random comics every 5 minutes. To unsubscribe from this, click on the unsubscribe link in the emails. THANK YOU! </span> </p>
        </div>
    </body>
</html>
