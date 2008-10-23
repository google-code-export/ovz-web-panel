<?php

define('ROOT_PATH', dirname(dirname(__FILE__)));

set_include_path(get_include_path() 
	. PATH_SEPARATOR . ROOT_PATH . '/externals/'
);

require_once('Zend/Loader.php');
Zend_Loader::registerAutoload();
