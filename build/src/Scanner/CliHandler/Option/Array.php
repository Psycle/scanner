<?php
class Scanner_CliHandler_Option_Array extends ArrayIterator implements Scanner_Option_Interface {

    protected $_config;
    
    public function setOption($option, $value) {
        $this->offsetSet($option, $value);
    }
    
    public function getOption($option, $default = null) {
        return $this->offsetExists($option) ? $this->offsetGet($option) : $default;
    }
    
    public function setOptions($options) {
        foreach ($options AS $option => $value)
        {
            $this->setOption($option, $value);
        }
    }
    
    public function getOptions() {
        return (array) $this;
    }
    
    public function getHelpText() {
        return 'TEST HELP TEXT';
    }
    
    public function setup($config = null) {
        $this->_config = $config;
    }
    
    public function parse() {
        
    }
}