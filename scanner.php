<?php
spl_autoload_register('autoloadcallback');
ini_set('display_errors',1);
function autoloadcallback($className) {
	$libPath = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'src';
	$classFile = str_replace('_',DIRECTORY_SEPARATOR,$className).'.php';
	$classPath = $libPath . DIRECTORY_SEPARATOR . $classFile;
    
	if (file_exists($classPath)) {
		require($classPath);
	} else {
        throw new Exception('file not found ' . $classPath);
    }
}


require_once dirname(__FILE__) . '/vendor/catacgc/juice-di-container/src/Container.php';

$di = new JuiceContainer();

$di['cli_optionhandler'] = JuiceDefinition::create('Scanner_CliHandler_Option');
$di['cli_handler'] = JuiceDefinition::create('Scanner_CliHandler', array('@cli_optionhandler'));


$di['cli_handler']->output(PHP_EOL);
$di['cli_handler']->run();
