<html>
<head>
  <title>email</title>
</head>
  <body>
    <?php
//require 'sendingemail.php';
require_once 'config.php';
$stmt=$pdo->prepare("UPDATE users SET password=:pw where email='deleteuser@gmail' ");
    $stmt->execute(array(
      ':pw'=> 'updatedpw'));
//$emails=array();
    
/*while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
  array_push($emails,$row['name']);
}  
for($i=0;$i<count($emails);$i++)
{   echo ($emails[$i]);
}*/
 
?>
<h1> data updated </h1>
</body>
</html>
