<?php
function acmeConnect(){
  $server = 'localhost';
  $dbName = 'acme';
  $username = 'iClient';
  $password = 'HlsQmnEBZ8Ss4QMo';
  $dsn = "mysql:host=$server;dbname=$dbName";
  $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

  try {
    $link = new PDO($dsn, $username, $password, $options);
    return $link;
    //echo 'Connection worked';
  } catch (PDOException $e) {
    header('location: /acme/view/500.php');
    //echo $e->getMessage();
    exit;
  }
}


 ?>
