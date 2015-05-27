<?php

# UTILES
define('DS', DIRECTORY_SEPARATOR);

# PATHS
define('BASE', $_SERVER['SCRIPT_NAME']);
define('ROOT', str_replace('index.php', '', BASE));
define('D_ASSETS', '.' . DS . 'assets');
define('D_COMPONENTS', '.' . DS . 'components');
define('D_CONFIGS', '.' . DS . 'configs');
define('D_CONTROLLERS', '.' . DS . 'controllers');
define('D_HELPERS', '.' . DS . 'helpers');
define('D_MODELS', '.' . DS . 'models');
define('D_VIEWS', '.' . DS . 'views');

