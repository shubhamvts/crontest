<html>
<head>
  <title>email</title>
</head>
  <body>
    <?php
require_once 'sendingemail.php';
require_once 'pdo.php';
$stmt=$pdo->query('SELECT * FROM users where subscribed="yes" ');
$i=0;
$emails=array();
while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
  array_push($emails,$row['name']);
}


    /*$url = 'https://c.xkcd.com/random/comic/';
    $headers = @get_headers($url,1);
    $actual_url=($headers['Location']); //redirected url from c.xkcd.com
    $json_url = $actual_url[0].'info.0.json'; //the json of the redirected url
    $json = file_get_contents($json_url); //getcontentoftheurl
    $data=json_decode($json);
    $title=$data->title;
    $imgurl=$data->img;*/

for($i=0;$i<count($emails);$i++)
{   echo $emails[$i];
    /*$to=$emails[$i];
    $message = '';
              
              SendEmail::SendMail($to,$title,'hi',$imgurl); */

  }
?>
<h1> you should receive an email </h1>
</body>
</html>
