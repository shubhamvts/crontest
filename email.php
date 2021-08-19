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
    $month=$data->month;
    $day=$data->day;
    $year=$data->year;
    $date=$day."/".$month."/".$year;
    
    //echo ("\n".$title."\n".$imgurl."\n");
for($i=0;$i<count($emails);$i++)
{  
  $to=$emails[$i];
  $subject='YOUR RANDOM COMIC';
  $unsublink='https://phprtcamp.herokuapp.com/unsubscribe.php?email='.$emails[i];
  $message= '
  <html>
  <head>
  </head>
  <body>
  <p> Hello, here is your random comic of 5 minutes </p>
  <p> <strong> TITLE : </strong> '.$title.' </p>
  <p> <strong> RELEASE DATE : </strong> '.$date.' </p>
  <p> <img src='.$imgurl.'> </p>
  <p> <a href='.$unsublink.' style="color:white;background-color:red"> CLICK HERE TO UNSUBSCRIBE <a></p>
  </body>
  </html>
  ';
  SendEmail::SendMail($to,$subject,$message,$imgurl);
    } 
?>
<h1> email sent</h1>
</body>
</html>
