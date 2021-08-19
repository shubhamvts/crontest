<html>
<head>
  <title>email</title>
</head>
  <body>
    <?php
//require 'sendingemail.php';
require_once 'config.php';
$stmt=$pdo->prepare(" INSERT INTO users (name,password,subscription) VALUES (:name,:pass,:val) ");
    $stmt->execute(array(
      ':name'=> 'shubhamvats830@gmail.com',
      ':pass'=> '9operamini',
      ':val'=> 'no' ));
//$emails=array();
    
/*while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
  array_push($emails,$row['name']);
}  
for($i=0;$i<count($emails);$i++)
{   echo ($emails[$i]);
}*/
 
?>
<h1> data inserted </h1>
</body>
</html>
