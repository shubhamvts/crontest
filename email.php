<html>
<head>
  <title>email</title>
</head>
  <body>
    <?php
//require 'sendingemail.php';
require_once 'config.php';
$stmt=$pdo->query(" SELECT # FROM users WHERE subscribed='yes' ");
$emails=array();
    
while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
  array_push($emails,$row['name']);
}  
for($i=0;$i<count($emails);$i++)
{   echo ($emails[$i]);
}
 
?>
<h1> you should receive an email </h1>
</body>
</html>
