<?php

abstract class Scanner_Test_Abstract implements Scanner_Test_Interface {

    public function __construct(Scanner_Option_Interface $options, Scanner_Output_Interface $outputInterface, Scanner_Log_Interface $logger) {
        $this->_options = $options;
        $this->_outputInterface = $outputInterface;
        $this->_logger = $logger;
        $this->_filePath = $this->_options->getOption('path', getcwd());
    }

    public function run() {
        try {
            $this->_run();
        } catch (Scanner_CliHandler_Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    abstract protected function _run();
}