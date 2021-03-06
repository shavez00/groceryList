<?php
require('../core.php');

try {
$config = array(
    // required credentials

    'host'       => 'localhost',
    'user'       => 'root',
    'password'   => 'adminadmin',
    'database'   => 'GroceryList',

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

$success = $dbh->executeSql("CREATE TABLE Users (
UserId MEDIUMINT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
email VARCHAR(255) NOT NULL
)");

if ($success) {
     echo "Table \"Users\" created.";
}
} catch (Exception $e) {
     $message = json_decode($e->getMessage());
     echo $message->errorInfo->message . "</br>dbFoodInfoTableCreate.php - line 41";
}
