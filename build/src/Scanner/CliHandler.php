<?php
class Scanner_CliHandler implements Scanner_Output_Interface, Scanner_Option_Interface {
    
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
     * @return Scanner_CliHandler_Colour
     */
    public function getColourClass() {
        if(is_null($this->_colourClass)) {
            $this->_colourClass = new Scanner_CliHandler_Colour;
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
    
    /**
     * 
     * @param type $option
     * @param type $value
     */
    public function setOption($option, $value) {
        
    }
    
    /**
     * 
     * @param type $option
     * @param type $default
     */
    public function getOption($option, $default = null) {
        
    }
    
    /**
     * 
     * @param type $options
     */
    public function setOptions($options) {
        
    }
    
    /**
     * 
     */
    public function getOptions() {
        
    }
}