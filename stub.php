<?php
Phar::mapPhar('Scanner.phar');
spl_autoload_register(function ($className) {
	$libPath = 'phar://Scanner.phar/src/';
	$classFile = str_replace('_',DIRECTORY_SEPARATOR,$className).'.php';
	$classPath = $libPath.$classFile;
    
	if (file_exists($classPath)) {
		require($classPath);
	}
});
$args = $argv;
array_shift($args);
//$Scanner = new Scanner($args);

$CliHandler = new Scanner_CliHandler($args);
$CliHandler->outputError('TEST STRING');
$CliHandler->outputMessage('TEST STRING');
__HALT_COMPILER();