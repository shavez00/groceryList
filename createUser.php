<?php<?php
require('core.php');

$vars = array_merge($_GET, $_POST);

session_start();

if (isset($_SESSION["userid"])) header ("Location: groceryList.php");

foreach ($vars as $k => $v) {
    if (!empty($v)) {
       $_SESSION["userid"] = "temp";
       header ("Location: index.php");
    }
}


echo <<<_END
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

                <!-- Form -->
                <form id="contact-form" action="" method="get">
                    <h3>Grocery List</h3></br>
                    <h3>MVP</h3>
                    <div><label><span>
                        Please create an account
                    </span></label></div>
                    <div><label>
                         <span>User Name:</span>
                         <input placeholder="User Name" type="text" name="username" tabindex="1" required>
                    </label></div>
                    <div><label>
                         <span>Password:</span>
                         <input placeholder="password" type="password" name="username" tabindex="1" required>
                    </label></div>
                    <div><label>
                         <span>Confirm Password:</span>
                         <input placeholder="password" type="password" name="username" tabindex="1" required>
                    </label></div>
                    <div><label>
                         <span>Email address:</span>
                         <input placeholder="you@somewhere.com" type="email" name="username" tabindex="1" required>
                    </label></div></br>
                    <div>
                        <button type="submit" id="contact-submit" tabindex="6">Submit</button>
                    </div>
                </form>
                <!-- /Form -->

            </div>
        </div>

        <script src="js/scripts.js"></script>

    </body>
</html>
_END;
