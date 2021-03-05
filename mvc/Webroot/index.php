<?php

require_once __DIR__ .'../../vendor/autoload.php';

use mvc\Dispatcher;

define('WEBROOT', str_replace("Webroot/index.php", "", $_SERVER["SCRIPT_NAME"])); // WEBROOT = mvc/
define('ROOT', str_replace("Webroot/index.php", "", $_SERVER["SCRIPT_FILENAME"])); // ROOT = /opt/lampp/htdocs/mvc/

$dispatch = new Dispatcher();
$dispatch->dispatch();

?>