<?php
require_once 'config.php';
$stmt=$pdo->prepare('INSERT INTO users (name, password, subscription) VALUES (:name,:pw,:val)');
$stmt->execute(array(
  ':name'=> 'ardentcrewu7@gmail.com',
  ':pw'=> 'benelli',
  ':val'=> 'yes'));

echo "record inserted";
?>
