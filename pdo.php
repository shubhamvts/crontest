<?php
$pdo=new mysqli("remotemysql.com","FDjM4OJk6J","8jAk1cFhRs","FDjM4OJk6J");
if(pdo->connect_errno){
  echo "failed";
}else{
  echo "succesful";
}
?>
