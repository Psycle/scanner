<?php
Phar::mapPhar('scanner.phar');
spl_autoload_register('autoloadcallback');
ini_set('display_errors',1);
function autoloadcallback($className) {
	$libPath = 'phar://scanner.phar/src/';
	$classFile = str_replace('_',DIRECTORY_SEPARATOR,$className).'.php';
	$classPath = $libPath.$classFile;
    
	if (file_exists($classPath)) {
		require($classPath);
	}
}


require_once 'phar://scanner.phar/vendor/catacgc/juice-di-container/src/Container.php';

require_once dirname(dirname(__FILE__)) . '/includes/setup_di.php';
__HALT_COMPILER();