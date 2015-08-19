<?php
require('core.php');
try {
$config = array(
    // required credentials

    'host'       => 'localhost',
    'user'       => 'root',
    'password'   => 'adminadmin',
    'database'   => 'mysql',

    // optional

    'fetchMode'  => \PDO::FETCH_ASSOC,
    'charset'    => 'utf8',
    'port'       => 3306,
    'unixSocket' => null,
);

// standard setup
$dbh = new \Simplon\Mysql\Mysql(
$config['host'],
$config['user'],
$config['password'],
$config['database']);

$success = $dbh->executeSql("CREATE DATABASE GroceryList");

if ($success) {
     echo "Database \"GroceryList\" created </br>Current existing databases</br>";
     $show = $dbh->getDbh();
     $databases = $show->query("SHOW DATABASES"); 

     $iterator = new \Simplon\Mysql\MysqlQueryIterator($databases, "fetch", \PDO::FETCH_NUM);

    $iterator->rewind();
    while($iterator->valid()) {
         $row = $iterator->current();
         echo $row[0] . "</br>";
         $iterator->next();
    }
} 
} catch (Exception $e) {
     $message = json_decode($e->getMessage());
     echo $message->errorInfo->message . "</br>dbCreate.php - line 45";
}