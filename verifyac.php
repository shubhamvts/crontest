<?php
session_start();
$pw='';
if(isset($_POST['vc'])) $oldguess1=$_POST['vc']; else $oldguess1=''; 
if(! isset($_GET['name'])) die('unauthorized access');
require_once 'config.php';
require 'vendor/autoload.php';
if($_SESSION['status']==FALSE){
$useremail=$_GET['name'];
$pw=rand(1000,9999);
$content ='
<html>
<head>
</head>
<body>
<p> Your Verification Code is : <strong> '.$pw.' </strong> </p>
<p> <strong> PLEASE NOTE THAT YOU WILL USE THIS VERIFICATION CODE FOR LOGIN. AFTER LOGGING IN, YOU CAN CHANGE YOUR PASSWORD. </strong> </p>
</body>
</html>
';
    $_SESSION['status']=TRUE;
    $email= new \SendGrid\Mail\Mail();
    $email->setFrom("shubhamvats830@gmail.com","Shubham Vats");
    $email->setSubject("Verification Email - 5 MINUTES COMICS BY XKCD");
    $email->addTo($useremail);
    $email->addContent("text/html",$content);
    $sendgrid = new \SendGrid(getenv('api_token'));
    try{
      $response = $sendgrid->send($email);
       return $response;
    }catch(Exception $e){
      echo 'Caught Exception : '.$e->getMessage()."\n";
      return false;
    }
  }
else if($oldguess1==$pw)
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
    <form method="post">
    <p> <span style="font-family:Arial"> Enter the 4-digit VERIFICAION CODE sent on your email id. </span> </p>
    <p> <input type="text" name="vc" value="<?=htmlentities($oldguess1)?>"/> </p>
    <p> <input style="color:whiteSmoke; background-color:black" type="submit" value="CONFIRM"/> </p>
      </form>
    <?php
      if(isset($_SESSION['error3'])) {
        echo "\n <p style='color:red'>".$_SESSION['error3']."</p";
        unset($_SESSION['error3']);
      }
      else if(isset($_SESSION['successful'])) {
        echo "\n <p style='color:green'>".$_SESSION['successful']." Please proceed to <a href='login.php'> LOGIN </a> </p";
        $stmt=$pdo->prepare('INSERT INTO users (name, password, subscription) VALUES (:name,:pw,:val)');
        $stmt->execute(array(
            ':name'=> $useremail,
            ':pw'=> $pw,
            ':val'=> 'no'));
          unset($_SESSION['successful']);
      }
    ?>
    </div>
</body>
</html>
