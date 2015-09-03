<?php
require('core.php');


$filename = dirname($_SERVER['SCRIPT_FILENAME']);

$f = file_get_contents($filename . '/groc');
$gl = unserialize($f) ;

print "<pre>";
print_r($gl);
print "</pre>";