<?php
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
    header('Location:verifyac.php?name='.htmlentities($oldguess));
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
      ?>
    </form>
    </div>
    </body>
    </html>
