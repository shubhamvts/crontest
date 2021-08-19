<html>
<head>
  <title>email</title>
</head>
  <body>
    <?php
require 'vendor/autoload.php';
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
    
    echo ("\n".$title."\n".$imgurl."\n");
for($i=0;$i<count($emails);$i++)
{    echo ($emails[$i]."\n");
}
  /*$to=$emails[$i];
  $subject='YOUR RANDOM COMIC';
  $message= '
              <html>
              <head>
              <title>Document</title>
              </head>
              <body>
              <h4>Hi,</h4><br>
              <p> HERE IS YOUR COMIC : </p>
              <p> COMIC TITLE = '.$title.' </p>
              <p> <img src='.$imgurl.' alt='comedy'> </p>
              <p> UNSUBSCRIBE HERE </p>
              </body>
              </html>
              ';
  
    $email= new \SendGrid\Mail\Mail();
    $email->setFrom("shubhamvats830@gmail.com","Shubham Vats");
    $email->setSubject($subject);
    $email->addTo($to);
    $email->addContent("text/html",$message);

$att1 = new \SendGrid\Mail\Attachment();
$att1->setContent(base64_encode(file_get_contents($imgurl)));
$att1->setType("image/jpeg");
$att1->setFilename("photo.");
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
 
} */
 
?>
<h1> email sent</h1>
</body>
</html>
