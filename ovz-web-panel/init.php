<?php

define('ROOT_PATH', dirname(__FILE__));

set_include_path(get_include_path() 
	. PATH_SEPARATOR . ROOT_PATH . '/externals/'
	. PATH_SEPARATOR . ROOT_PATH . '/modules/default/models/'
);

require_once('Zend/Loader.php');
Zend_Loader::registerAutoload();
