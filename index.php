<?php
require 'vendor/autoload.php';
session_start();
$oldguess=isset($_POST['email'])?$_POST['email']:'';
if(empty($oldguess))
  {
    $_SESSION["error1"]="*field cannot be left empty";
  }
else {
  $ch1='@';
  $ch2='.';
  $pos1=strpos($oldguess,$ch1);
  $pos2=strpos($oldguess,$ch2);
  if($pos1===false || $pos2===false)
  {
    $_SESSION["error2"]='invalid email format';
  }
  else {
$pw=rand(1000,9999);
$md=md5($pw);
$useremail=$_GET['name'];
$url='verify.php?name='.$useremail.'&id='.$md5;
$content ='
<html>
<head>
</head>
<body>
<p> CLICK BELOW TO VERIFY THIS ACCOUNT : </p>
<p> <a href='.$url.'> Redirect to Verification Page </a> </p>
</body>
</html>
$_SESSION['success']='Please verify your email by clicking in the link you received in the email';
';
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
  ?>

  }
}

?>

<html>
<head>
  <title> WELCOME TO 5 MINUTE COMICS </title>
  <style>
  form {
    border : 2px solid green;
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
      <p> <h4> <span style="color:green; font-family:Arial"> Welcome to 5 minute comics by XKCD </span> </h4> </p>
    <form method="post">
      <p> Enter your e-mail address to continue </p>
      <p> <input type="text" name="email" value="<?=htmlentities($oldguess)?>"/> </p>
      <p> <input style="color:whiteSmoke; background-color:black" type="submit" value="NEXT"/> </p>
      <?php
        if(isset($_SESSION['error1'])) {
          echo "\n <p style='color:red'>".$_SESSION['error1']."</p";
          unset($_SESSION['error1']);
        }
        if(isset($_SESSION['error2'])) {
          echo "\n <p style='color:red'>".$_SESSION['error2']."</p";
          unset($_SESSION['error2']);
        }
    if(isset($_SESSION['success'])) {
      echo "\n <p style='color:green'>".$_SESSION['success']."</p>";
      unset($_SESSION['success']);
      ?>
    </form>
    </div>
    </body>
    </html>
