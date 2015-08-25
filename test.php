<?php
require('core.php');

$Food = new Food("Grape");


$Food->updateProperties(["category"=>"fruit", "UPC"=>"11112"]);

$result = $Food->getFood();

/**$dbh = new \Simplon\Mysql\glDbMysql();
$result = $dbh->executeSql("UPDATE Food SET UPC = '456'");

/**
$config = array(
    // required credentials

    'host'       => 'localhost',
    'user'       => 'root',
    'password'   => 'adminadmin',
    'database'   => 'groceryList',

    // optional

    'fetchMode'  => \PDO::FETCH_ASSOC,
    'charset'    => 'utf8',
    'port'       => 3306,
    'unixSocket' => null,
);

// standard setup
$dbConn = new \Simplon\Mysql\Mysql(
$config['host'],
$config['user'],
$config['password'],
$config['database']);

$dbConn = new \Simplon\Mysql\glDbMysql();

$data = array(
    'name' => 'Peter',
    'email'  => "shavez@home.com",
);


 try {
$id = $dbConn->getRows("users", $data);
} catch (Exception $e) {
	   echo $e->getMessage();
}*/
print "<pre>";
print_r ($result);
print "<pre>";
?>
