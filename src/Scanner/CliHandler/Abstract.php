<?php

abstract class Scanner_CliHandler_Abstract {

    
    
    
    /**
     *
     * @var Scanner_Log_Interface 
     */
    protected $_logger;

    /**
     *
     * @var Scanner_Output_Interface
     */
    protected $_outputInterface;
    
    /**
     * 
     * @param Scanner_Option_Interface $optionInterface
     */
    public function __construct(Scanner_Output_Interface $outputInterface, Scanner_Option_Interface $optionInterface, Scanner_Log_Interface $logger) {
        $this->_optionInterface = $optionInterface;
        $this->_outputInterface = $outputInterface;
        $this->_logger = $logger;
        $this->_setup();        
    }
    
    /**
     * 
     * @return Scanner_Output_Interface
     */
    public function getOutputInterface() {
        return $this->_outputInterface;
    }
    
    public function setOutputInterface(Scanner_Output_Interface $interface) {
        $this->_outputInterface = $interface;
    }
    
    protected function _setup() {
        $this->_optionInterface->setup($this->_options);
    }
}