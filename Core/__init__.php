<?php

use Core\Autoloader;

define('DS', DIRECTORY_SEPARATOR);
define('ROOT_DIR', dirname(__DIR__));
define('APP_DIR', ROOT_DIR . DS . 'App');
define('CONTROLLERS_DIR', ROOT_DIR . DS . 'App' . DS . 'Controllers');
define('MODELS_DIR', ROOT_DIR . DS . 'App' . DS . 'Models');
define('VIEWS_DIR', ROOT_DIR . DS . 'App' . DS . 'Views');
define('TEMPLATES_DIR', ROOT_DIR . DS . 'App' . DS . 'templates');
define('DATA_DIR', ROOT_DIR . DS . 'App' . DS . 'Data');
define('CORE_DIR', ROOT_DIR . DS . 'Core');
define('CONFIG_DIR', ROOT_DIR . DS . 'Config');
define('HELPERS_DIR', ROOT_DIR . DS . 'Core' . DS . 'helpers');
define('LIBS_DIR', ROOT_DIR . DS . 'Core' . DS . 'Libs');

require CORE_DIR . DS . 'Autoloader.php';
require LIBS_DIR . DS . 'outils.php';

loadHelpers();
// loadENV();
Autoloader::register();
