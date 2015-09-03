<?php
require('core.php');

$gl = new GroceryList();

$food = new Food("", 1);
$food2 = new Food("", 4);

$foodtmp = $food->getFood();
$foodtmp2 = $food2->getFood();

$glitem = ["quantity"=>5, $foodtmp["foodId"]=>$food];
$glitem2 = ["quantity"=>2, $foodtmp2["foodId"]=>$food2];


$gl[$foodtmp["description"]] = $glitem;
$gl[$foodtmp2["description"]] = $glitem2;

//$result = $gl;
print "<pre>";
print_r($gl);
print "</pre>";

/**
$f = serialize($gl) ;
file_put_contents('gl', $f);

$result = array();

for ($i = 1; $i < count($gl) + 1; $i++) {
    array_unshift($result, $gl[$i]);
}


/**$Food = new Food("Grape");


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
