<?php
require_once 'pdo.php';
require 'vendor/autoload.php';
$stmt=$pdo->query('SELECT * FROM users where subscribed="yes" ');
$i=0;
$emails=array();
while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
  array_push($emails,$row['name']);
}


    $url = 'https://c.xkcd.com/random/comic/';
    $headers = @get_headers($url,1);
    $actual_url=($headers['Location']); //redirected url from c.xkcd.com
    $json_url = $actual_url[0].'info.0.json'; //the json of the redirected url
    $json = file_get_contents($json_url); //getcontentoftheurl
    $data=json_decode($json);

for($i=0;$i<count($emails);$i++)
{ //convertingintojsonobject
    $message = '
              <html>
              <head>
              <title>Document</title>
              </head>
              <body>
              <h4>Hi,</h4><br>
              <p> HERE IS YOUR COMIC : </p>
              <p> COMIC TITLE = '.$data->title.' </p>
              <p> <img src='.$data->img.' alt='comic'> </p>
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
?>
