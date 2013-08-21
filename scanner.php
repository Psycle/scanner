<?php
spl_autoload_register('autoloadcallback');
ini_set('display_errors',1);
function autoloadcallback($className) {
	$libPath = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'src';
	$classFile = str_replace('_',DIRECTORY_SEPARATOR,$className).'.php';
	$classPath = $libPath . DIRECTORY_SEPARATOR . $classFile;
    
	if (file_exists($classPath)) {
		require($classPath);
	}
    
    return false;
}


require_once dirname(__FILE__) . '/vendor/catacgc/juice-di-container/src/Container.php';

require_once dirname(__FILE__) . '/setup_di.php';
