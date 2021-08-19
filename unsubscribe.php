<?php
require_once 'config.php';
if(!isset($_GET['email']) die("Unauthorized Access");
$unmail=$_GET['email'];
$stmt=$pdo->prepare("UPDATE users SET subscription=:val WHERE name=:unmail");
   $stmt->execute(array(
     ':val'=>'no',
     ':unmail'=>$unmail ));
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
     .cntr2{
    border : 2px solid black;
    padding: 20px;
    display: inline-block;
  }
    </style>
  </head>
  <body>
    <div class="cntr">
      <div class="cntr2">
        <p> You are now unsubscribed from the service. Kindly register again with your email to get 5 minute comic updates. </p>
      </div>
    </div>
  </body>
</html>
