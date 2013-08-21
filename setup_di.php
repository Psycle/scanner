<?php
$di = new JuiceContainer();
$di['filter_string'] = JuiceDefinition::create('Scanner_Util_Filter_String');
$di['logger'] = JuiceDefinition::create('Scanner_Log_ErrorLog');
$di['output_interface'] = JuiceDefinition::create('Scanner_Output_Cli');
$di['cli_optionhandler'] = JuiceDefinition::create('Scanner_CliHandler_Option_GetOpt');
$di['cli_handler'] = JuiceDefinition::create('Scanner_CliHandler', array('@output_interface', '@cli_optionhandler', '@logger'))->call('setStringFilterInterface', array('@filter_string'));


$di['cli_handler']->getOutputInterface()->output(PHP_EOL);
$di['cli_handler']->run();