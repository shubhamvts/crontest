<html>
<head>
  <title>email</title>
</head>
  <body>
    <?php
//require 'sendingemail.php';
require_once 'config.php';
$stmt=$pdo->prepare("CREATE TABLE users(
name VARCHAR(128),
password VARCHAR(128),
subscription VARCHAR(128)
);
");
  $stmt=$pdo->exec();
/*$emails=array();
    
while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
  array_push($emails,$row['name']);
}  
for($i=0;$i<count($emails);$i++)
{   echo ($emails[$i]);
}*/
    echo "Record added';
 
?>
<h1> you should receive an email </h1>
</body>
</html>
