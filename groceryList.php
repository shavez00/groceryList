<?php
require('core.php');

$vars = array_merge($_GET, $_POST);

foreach ($vars as $k => $v) {
    if (empty($v)) header("Location: index.php");
}

var_dump($vars);

