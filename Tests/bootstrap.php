<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * @author jamesrobinson
 */
// TODO: check include path
ini_set('include_path', ini_get('include_path').PATH_SEPARATOR.dirname(__FILE__).'/../../../../../../../Applications/MAMP/bin/php/php5.2.17/lib/php/PHPUnit');

spl_autoload_register('autoloadcallback');
ini_set('display_errors',1);
function autoloadcallback($className) {
	$libPath = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'src';
	$classFile = str_replace('_',DIRECTORY_SEPARATOR,$className).'.php';
	$classPath = $libPath . DIRECTORY_SEPARATOR . $classFile;
    
	if (file_exists($classPath)) {
		require($classPath);
	} else {
        throw new Exception('file not found ' . $classPath);
    }
}

require_once dirname(dirname(__FILE__)) . '/vendor/catacgc/juice-di-container/src/Container.php';

?>
