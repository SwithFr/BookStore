<?php

# PATHS
define('BASE',$_SERVER['SCRIPT_NAME']);
define('ROOT',str_replace('index.php','',BASE));
define('D_ASSETS','./assets');
define('D_COMPONENTS','./components');
define('D_CONFIGS','./configs');
define('D_CONTROLLERS','./controllers');
define('D_HELPERS','./helpers');
define('D_MODELS','./models');
define('D_VIEWS','./views');

# UTILES
define('DS', DIRECTORY_SEPARATOR);