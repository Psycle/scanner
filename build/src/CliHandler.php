<?php
class NeoPh_CliHandler {
    
    public $streamPath = 'php://stdout';
    protected $_outputStream;
    protected $_rawArgs;
    protected $_colourClass;
    
    public function __construct($args) {
        $this->_rawArgs = $args;
    }

    public function getStreamResource() {
        if(is_null($this->_outputStream))
        {
            $this->_outputStream = fopen($this->streamPath, 'r');
        }
        
        return $this->_outputStream;
    }
    
    public function writeToOutput($string) {
        fwrite($this->getStreamResource(), $string);
        return $this;
    }
    
    public function __destruct() {
        fclose($this->getStreamResource());
    }
    
    public function output($string, $colour = 'white') {
        $this->writeToOutput($this->getColourClass()->getColoredString($string, $colour) . PHP_EOL);
    }
    
    /**
     * 
     * @return CliHandler_Colour
     */
    public function getColourClass() {
        if(is_null($this->_colourClass)) {
            $this->_colourClass = new CliHandler_Colour;
        }
        
        return $this->_colourClass;
    }
    
    /**
     * 
     * @param string $string
     */
    public function outputMessage($string) {
        $this->output($string, 'green');
    }
    
    /**
     * 
     * @param string $string
     */
    public function outputError($string) {
        $this->output($string, 'red');
    }
}