<html>
<head>
  <title>email</title>
</head>
  <body>
    <?php
//require 'sendingemail.php';
require_once 'config.php';
$stmt=$pdo->query("SELECT * from users where subscription='yes' ");
$emails=array();
while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
  array_push($emails,$row['name']);
}  
for($i=0;$i<count($emails);$i++)
{   echo ($emails[$i]);
}
 
?>
<h1> data updated </h1>
</body>
</html>
