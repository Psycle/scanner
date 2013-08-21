<?php

class Scanner_CliHandler_Option extends Scanner_CliHandler_Option_Abstract implements Scanner_Option_Interface {

    const GETOPT_NOTSWITCH = 0;
    const GETOPT_SWITCH = 1;
    const GETOPT_ACCUMULATE = 2;
    const GETOPT_VAL = 3;
    const GETOPT_MULTIVAL = 4;
    const GETOPT_KEYVAL = 5;
    
    public function __construct($getOptHandler) {
        parent::__construct();
    }
    
    protected function _getRawOptions() {
        return $this->getopt($this->_getShortOptions(), $this->_getLongOptions());
    }
}