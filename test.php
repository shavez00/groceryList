<?php
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(254) NOT NULL DEFAULT '',
  `created_at` int(10) unsigned NOT NULL,
  `updated_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

$config = array(
    // required credentials

    'host'       => 'localhost',
    'user'       => 'rootuser',
    'password'   => 'rootuser',
    'database'   => 'our_database',

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
    $config['database']
);

class UserVo extends \Simplon\Mysql\Crud\SqlCrudVo
{
    protected $id;
    protected $name;
    protected $email;
    protected $createdAt;
    protected $updatedAt;

    // ... here goes getter/setter for the above variables
} 

/**
* construct it with an instance of your simplon/mysql
*/
$sqlCrudManager = new \Simplon\Mysql\Crud\SqlCrudManager($dbConn);

//Create a user:

$userVo = new UserVo();

$userVo
    ->setId(null)
    ->setName('Johnny Foobar')
    ->setEmail('foo@bar.com');

/** @var UserVo $userVo */
$userVo = $sqlCrudManager->create($userVo);

// print insert id
echo $userVo->getId(); // 1
?>
