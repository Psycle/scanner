<?php

class Scanner {
    
    /**
     *
     * @var string
     */
    protected $_paths;
    
    /**
     *
     * @var array
     */
    protected $_tests = array();
    
    /**
     *
     * @var Scanner_Results 
     */
    protected $_results;
    
    protected $_outputHandler;
    
    protected $_optionHandler;
    
    protected $_extensions = array();
    
    public function setOutputHandler(Scanner_Output_Interface $handler) {
        $this->_outputHandler = $handler;
    }
    
    public function setOptionHandler(Scanner_Option_Interface $handler) {
        $this->_optionHandler = $handler;
    }
    
    /**
     * 
     * @param string $options
     * @return Scanner Description
     */
    public function setOptions($options) {
        
        foreach ($options AS $option => $val) {
            if(is_numeric($option)) {
                $optionArray = explode('=', $val);
                $option = array_shift($optionArray);
                $val = array_shift($optionArray);
                $option = preg_replace('@^\-{1,2}@', '', $option);
            }
            
            $this->setOption($option, $val);
        }
        
        return $this;
    }
    
    /**
     * 
     * @param string $option
     * @param string $val
     */
    public function setOption($option, $val) {
        switch ($option) {
            case 'e':
                $this->_extensions = explode(',', $val);
                break;
            default :
                throw new Scanner_InvalidArgumentException('Option ' . $option . ' is not recognised.');
                break;
        }
    }
    
    /**
     * 
     * @param string|array $path
     * @return \Scanner
     */
    public function addPath($path) {
        if(is_string($path))
        {
            $this->_paths[] = $path;
        } else {
            $this->_paths = array_merge($this->_paths, $path);
        }
        
        return $this;
    }
    
    /**
     * 
     * @param Scanner_Test_Interface $test
     * @return \Scanner
     */
    public function addTest(Scanner_Test_Interface $test) {
        $this->_tests[get_class($test)] = $test;
        return $this;
    }
    
    /**
     * 
     * @param string|Scanner_Test_Interface $testClass
     * @return \Scanner
     */
    public function removeTest($testClass) { 
        unset($this->_tests[is_object($testClass) ? get_class($testClass) : $testClass]);
        return $this;
    }
    
    /**
     * 
     * @param \Scanner_Result $result
     * @return \Scanner Description
     */
    public function addResult(Scanner_Result $result) {
        return $this;
    }
}