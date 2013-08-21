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

$di = new JuiceContainer();
$di['filter_string'] = JuiceDefinition::create('Scanner_Util_Filter_String');
$di['logger'] = JuiceDefinition::create('Scanner_Log_ErrorLog');
$di['cli_optionhandler'] = JuiceDefinition::create('Scanner_CliHandler_Option_GetOpt');
$di['cli_handler'] = JuiceDefinition::create('Scanner_CliHandler', array('@cli_optionhandler', '@logger'))->call('setStringFilterInterface', array('@filter_string'));


$di['cli_handler']->output(PHP_EOL);
$di['cli_handler']->run();
