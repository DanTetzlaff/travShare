<?php
require_once('../common/protected/travel-config.php');

spl_autoload_register(function ($class) {
    $file = '../common/dataAccess/' . $class . '.class.php';
    if (file_exists($file)) 
      include $file;
    else
      include 'lib/model/' . $class . '.class.php';
});

$dbAdapter = DatabaseAdapterFactory::create('PDO', array(DBCONNECTION, DBUSER, DBPASS));

?>