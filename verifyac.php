<?php
session_start();
$pw='';
if(! isset($_GET['name'])) die('unauthorized access');
require_once 'config.php';
require 'vendor/autoload.php';
if($_SESSION['status']==false){
$useremail=$_GET['name'];
$pw=rand(1000,9999);
$content ='
<html>
<head>
</head>
<body>
<p> Your Verification Code is : <strong> '.$pw.' </strong> </p>
<p> <strong> PLEASE NOTE THAT YOU WILL USE THIS VERIFICATION CODE FOR LOGIN. AFTER LOGGIN IN, YOU CAN CHANGE YOUR PASSWORD. </strong> </p>
</body>
</html>
';
    $email= new \SendGrid\Mail\Mail();
    $email->setFrom("shubhamvats830@gmail.com","Shubham Vats");
    $email->setSubject("Verification Email");
    $email->addTo($useremail);
    $email->addContent("text/html",$content);
    $sendgrid = new \SendGrid(getenv('api_token'));
    try{
      $response = $sendgrid->send($email);
       return $response;
       $_SESSION['status']=true;
    }catch(Exception $e){
      echo 'Caught Exception : '.$e->getMessage()."\n";
      return false;
    }
  }
if($_POST['vc']==$pw)
{
  $_SESSION['successful']="SUCCESSFULLY VERIFIED";
}
else{
  $_SESSION['error3']="Wrong/no code entered";
}
?>

<html>
<head>
  <style>
  form {
    border : 2px solid red;
    padding: 20px;
    display: inline-block;

  }
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
    <?php
    if(!empty($_POST['vc'])){
      if(isset($_SESSION['error3'])) {
        echo "\n <p style='color:red'>".$_SESSION['error3']."</p";
        unset($_SESSION['error1']);
      }
      else if(isset($_SESSION['successful'])) {
        echo "\n <p style='color:green'>".$_SESSION['successful']." Please proceed to <a href='login.php'> LOGIN </a> </p";
        unset($_SESSION['error2']);
        $stmt=$pdo->prepare('INSERT INTO users (name, password, subscription) VALUES (:name,:pw,:val)');
        $stmt->execute(array(
            ':name'=> $_POST['vc'],
            ':pw'=> $pw,
            ':val'=> 'no'));
      }
    }
    ?>
    <form method="post">
    <p> <span style="font-family:Arial"> Enter the 4-digit VERIFICAION CODE sent on your email id. </span> </p>
    <p> <input type="text" name="vc" value=""/> </p>
    <p> <input style="color:whiteSmoke; background-color:black" type="submit" value="CONFIRM"/> </p>
</body>
</html>
