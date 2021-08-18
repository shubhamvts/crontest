<?php
require_once 'pdo.php';
require 'vendor/autoload.php';
$stmt=$pdo->query("SELECT * FROM users ");
$i=0;
$subs=array();
$emails=array();
while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
  array_push($emails,$row['name']);
  array_push($subs,$row['subscribed']);
}
for($i=0;$i<count($emails);$i++)
{
  if($subs[i]=="yes")
  {
    $url = "https://c.xkcd.com/random/comic/";
    $headers = @get_headers($url,1);
    $actual_url=($headers['Location']); //redirected url from c.xkcd.com
    $json_url = $actual_url[0].'info.0.json'; //the json of the redirected url
    $json = file_get_contents($json_url); //getcontentoftheurl
    $data=json_decode($json); //convertingintojsonobject
    echo $data->img;
    $message = '
              <html>
              <head>
              <title>Document</title>
              </head>
              <body>
              <h4>Hi '.$emails[$i].',</h4><br>
              <p> HERE IS YOUR COMIC : </p>
              <p> COMIC TITLE = '.$data->title.' </p>
              <p> <img src='.$data->img.'>
              <p> UNSUBSCRIBE HERE </p>
              </body>
              </html>

              ';

              $email= new \SendGrid\Mail\Mail();
    $email->setFrom("shubhamvats830@gmail.com","Shubham Vats");
    $email->setSubject("5 MINUTES COMIC");
    $email->addTo($emails[i]);
    $email->addContent("text/html",$message);
     $url2=$data->img;

$att1 = new \SendGrid\Mail\Attachment();
$att1->setContent(base64_encode(file_get_contents($url2)));
$att1->setType("image/jpeg");
$att1->setFilename("random comic");
$att1->setDisposition("attachment");
$email->addAttachment( $att1 );

    $sendgrid = new \SendGrid(getenv('api_token'));


    try{
      $response = $sendgrid->send($email);
       return $response;
    }catch(Exception $e){
      echo 'Caught Exception : '.$e->getMessage()."\n";
      return false;
    }

  }
}

echo "check for email";
?>
