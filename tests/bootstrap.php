<?php

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'testing'));

// Ensure library/ is on include_path
/*
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));
*/
require_once 'Zend/Loader/Autoloader.php';
Zend_Loader_Autoloader::getInstance();
$resourceLoader = new Zend_Loader_Autoloader_Resource(array(
                'basePath' => APPLICATION_PATH,
                'namespace' => '',
            ));


$resourceLoader->addResourceType('loader', 'loaders/', 'My_Loader_');

$autoLoader->pushAutoloader($resourceLoader);
$autoLoader->pushAutoloader(new My_Loader_Autoloader_PhpThumb());
$autoloader->registerNamespace('PhpThumb_');