<?php
require('core.php');

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
$id = $dbConn->getRows("users", array("email" => "shavez@home.com", "name" => "Peter"));
} catch (Exception $e) {
	   echo $e->getMessage();
}
print "<pre>";
print_r ($id);
print "<pre>";
?>
