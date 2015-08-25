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

$success = $dbh->executeSql("Create Table NutritionalInfo (
Nutrionalinfoid Tinyint(6) Unsigned Auto_Increment Primary Key,
Calories Tinyint(6) Null,
CaloriesUnit Char(2) Null,
Protein Tinyint(6) Null,
ProteinUnit Char(2) Null,
Fat Tinyint(6) Null,
FatUnit Char(2) Null,
Carbohydrates Tinyint(6) Null,
CarbohydratesUnit Char(2) Null,
Sugars Tinyint(6) Null,
SugarsUnit Char(2) Null,
Fiber Tinyint(6) Null,
FiberUnit Char(2) Null,
Calcium Tinyint(6) Null,
CalciumUnit Char(2) Null,
Iron Decimal(6,2) Null,
IronUnit Char(2) Null,
Magnesium Tinyint(6) Null,
MagnesiumUnit Char(2) Null,
Potassium Tinyint(6) Null,
PotassiumUnit Char(2) Null,
Sodium Tinyint(6) Null,
SodiumUnit Char(2) Null,
Zinc Tinyint(6) Null,
ZincUnit Char(2) Null,
`Vitamin C` Tinyint(6) Null,
CUnit Char(2) Null,
Thiamin Decimal(6,4) Null,
ThiaminUnit Char(2) Null,
Riboflavin Decimal(6,4) Null,
RiboflavinUnit Char(2) Null,
Niacin Decimal(6,4) Null,
NiacinUnit Char(2) Null,
`Vitamin B-6` Decimal(6,4) Null,
`B-6Unit` Char(2) Null,
Folate Decimal(6,4) Null,
FloateUnit Char(2) Null,
`Vitamin B-12` Decimal(6,4) Null,
`B-12Unit` Char(2) Null,
`Vitamin A` Decimal(6,4) Null,
AUnit Char(2) Null,
`Vitamin E` Decimal(6,4) Null,
EUnit Char(2) Null,
`Vitamin D` Decimal(6,4) Null,
DUnit Char(2) Null,
`Vitamin K` Decimal(6,4) Null,
KUnit Char(2) Null,
Saturated Decimal(6,4) Null,
SaturatedUnit Char(2) Null,
Monounsaturated Decimal(6,4) Null,
MonounsaturatedUnit Char(2) Null,
Polyunsaturated Decimal(6,4) Null,
PolyunsaturatedUnit Char(2) Null,
Cholesterol Decimal(6,4) Null,
CholesterolUnit Char(2) Null,
Caffeine Decimal(6,4) Null,
CaffeineUnit Char(2) Null
)");

if ($success) {
     echo "Table \"NutrionalInfo\" created.";
}
} catch (Exception $e) {
     $message = json_decode($e->getMessage());
     echo $message->errorInfo->message . "</br>dbNutritionalInfoTableCreate.php - line 93";
}
