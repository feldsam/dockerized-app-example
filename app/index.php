<?php

$dbName = getenv('DBNAME');
$dbUser = getenv('DBUSER');
$dbPass = getenv('DBPASS');

try {
  $pdo = new PDO('mysql:host=mysql;dbname='.$dbName.';charset=utf8', $dbUser, $dbPass);
} catch (PDOException $e) {
  header("HTTP/1.0 500 Internal Server Error");
  echo 'Connection to mysql failed: ' , $e->getMessage();
  exit(1);
}

echo '<b>Mysql:</b> Connection success<br>';

$m = new Memcached();
$m->addServer('memcached', 11211);
$m->set('bool', true);
if(!$m->get('bool')) {
  header("HTTP/1.0 500 Internal Server Error");
  echo 'Connection to memcached failed!';
  exit(1);
}

echo '<b>Memcached:</b> Connection success<br>';

phpinfo();