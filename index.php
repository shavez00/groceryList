<?php
require('core.php');

$config = array(
    // required credentials

    'host'       => 'localhost',
    'user'       => 'shavez00',
    'password'   => 'morgan08',
    'database'   => 'recipe',

    // optional

    'fetchMode'  => \PDO::FETCH_ASSOC,
    'charset'    => 'utf8',
    'port'       => 3306,
    'unixSocket' => null,
);

//session_start();

$dbConn = new \Simplon\Mysql\Mysql(
    $config['host'],
    $config['user'],
    $config['password'],
    $config['database']
);

var_dump($dbConn);

$userid = array("userid" => "26");

$id = $dbConn->getRow('users', $userid);

//if ($_SESSION['userid'] == $dbConn->) header ("Location: groceryList.php");

//session_unset();

?><!---
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Grocery List</title>
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <meta name="author" content="@shavez00">
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body>

        <div class="wrapper">
            <div id="main" style="padding:50px 0 0 0;">

                <!-- Form --
                <form id="contact-form" action="groceryList.php" method="get">
                    <h3>Grocery List</h3></br>
                    <h3>MVP</h3>
                    <div><label><span>
                        User Log In
                    </span></label></div>
                    <div><label>
                         <span>User Name:</span>
                         <input placeholder="User Name" type="text" name="username" tabindex="1">
                    </label></div>
                    <div><label>
                         <span>Password:</span>
                         <input placeholder="User Name" type="password" name="password" tabindex="2">
                    </label></div>
                    </br>
                    <div>
                        <button type="submit" id="contact-submit" tabindex="6">Log In</button>
                        <button type="submit" id="contact-submit" formaction="createUser.php" tabindex="6">Create Account</button>
                    </div>
                </form>
                <!-- /Form --

            </div>
        </div>

        <script src="js/scripts.js"></script>

    </body>
</html>

