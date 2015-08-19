<?php
require('core.php');

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

$success = $dbh->executeSql("Create Table Food (
Nutrionalinfoid Tinyint(6) Unsigned Auto_Increment Primary Key,
Calories Tinyint(6) Null,
Caloriesunit Char(2) Null,
Protein Tinyint(6) Null,
Proteinunit Char(2) Null,
Fat Tinyint(6) Null,
Fatunit Char(2) Null,
Carbohydrates Tinyint(6) Null,
Carbohydratesunit Char(2) Null,
Sugars Tinyint(6) Null,
Sugarsunit Char(2) Null,
Fiber Tinyint(6) Null,
Fiberunit Char(2) Null,
Calcium Tinyint(6) Null,
Calciumunit Char(2) Null,
Iron Decimal(6,2) Null,
Ironunit Char(2) Null,
Magnesium Tinyint(6) Null,
Magnesiumunit Char(2) Null,
Potassium Tinyint(6) Null,
Potassiumunit Char(2) Null,
Sodium Tinyint(6) Null,
Sodiumunit Char(2) Null,
Zinc Tinyint(6) Null,
Zincunit Char(2) Null,
`vitamin C` Tinyint(6) Null,
Cunit Char(2) Null,
Thiamin Decimal(6,4) Null,
Thiaminunit Char(2) Null,
Riboflavin Decimal(6,4) Null,
Riboflavinunit Char(2) Null,
Niacin Decimal(6,4) Null,
Niacinunit Char(2) Null,
`vitamin B-6` Decimal(6,4) Null,
`b-6unit` Char(2) Null,
Folate Decimal(6,4) Null,
Floateunit Char(2) Null,
`vitamin B-12` Decimal(6,4) Null,
`b-12unit` Char(2) Null,
`vitamin A` Decimal(6,4) Null,
Aunit Char(2) Null,
`vitamin E` Decimal(6,4) Null,
Eunit Char(2) Null,
`vitamin D` Decimal(6,4) Null,
Dunit Char(2) Null,
`vitamin K` Decimal(6,4) Null,
Kunit Char(2) Null,
Saturated Decimal(6,4) Null,
Saturatedunit Char(2) Null,
Monounsaturated Decimal(6,4) Null,
Monounsaturatedunit Char(2) Null,
Polyunsaturated Decimal(6,4) Null,
Polyunsaturatedunit Char(2) Null,
Cholesterol Decimal(6,4) Null,
Cholesterolunit Char(2) Null,
Caffeine Decimal(6,4) Null,
Caffeineunit Char(2) Null
)");

if ($success) {
     echo "Table \"Food\" created.";
}
} catch (Exception $e) {
     $message = json_decode($e->getMessage());
     echo $message->errorInfo->message . "</br>dbNutritionalInfoTableCreate.php - line 93";
}
