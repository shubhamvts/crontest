<html>
<head>
  <title>email</title>
</head>
  <body>
    <?php
require_once "sendingemail.php";
require_once 'config.php';
$stmt=$pdo->query("SELECT * from users where subscription='yes' ");
$emails=array();
while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
  array_push($emails,$row['name']);
} 
$url = "https://c.xkcd.com/random/comic/";
$headers = @get_headers($url,1);
$actual_url=($headers['Location']); //redirected url from c.xkcd.com
$json_url = $actual_url[0].'info.0.json'; //the json of the redirected url
$json = file_get_contents($json_url); //getcontentoftheurl
$data=json_decode($json); //convertingintojsonobject
$title=$data->title;
$imgurl=$data->img;
    
    //echo ("\n".$title."\n".$imgurl."\n");
for($i=0;$i<count($emails);$i++)
{    echo ($emails[$i]."\n");
  $to=$emails[$i];
  $subject='YOUR RANDOM COMIC';
  $message= '
  <html>
  <head>
  </head>
  <body>
  <p> hello </p>
  </body>
  </html>
  ';
  SendEmail::SendMail($to,$subject,$message,$imgurl);
    } 
?>
<h1> email sent</h1>
</body>
</html>
