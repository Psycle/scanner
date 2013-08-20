<?php

class Scanner_Test_Longword implements Scanner_Test_Interface {
    
    /**
     *
     * @var Scanner_Output_Interface 
     */
    protected $_outputInterface;
    
    /**
     *
     * @var Scanner_Log_Interface 
     */
    protected $_logger;
    
    /**
     *
     * @var string 
     */
    protected $_filePath;
    
    public function __construct(Scanner_Output_Interface $outputInterface, Scanner_Log_Interface $logger) {
        $this->_outputInterface = $outputInterface;
        $this->_logger = $logger;
    }
    
    public function run($filePath) {
        $this->_filePath = $filePath;
    }
}