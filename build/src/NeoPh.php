<?php

class NeoPh {
    
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
     * @var NeoPh_Results 
     */
    protected $_results;
    
    protected $_extensions = array();
    
    /**
     * @param string|array $path
     */
    public function __construct($path) {
        $args = func_get_args();
        
        $path = array_shift($args[0]);
        $this->setOptions($args[0]);
        $this->addPath($path);
    }
    
    /**
     * 
     * @param string $options
     * @return NeoPh Description
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
                throw new NeoPh_InvalidArgumentException('Option ' . $option . ' is not recognised.');
                break;
        }
    }
    
    /**
     * 
     * @param string|array $path
     * @return \NeoPh
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
     * @param NeoPh_Test_Interface $test
     * @return \NeoPh
     */
    public function addTest(NeoPh_Test_Interface $test) {
        $this->_tests[get_class($test)] = $test;
        return $this;
    }
    
    /**
     * 
     * @param string|NeoPh_Test_Interface $testClass
     * @return \NeoPh
     */
    public function removeTest($testClass) { 
        unset($this->_tests[is_object($testClass) ? get_class($testClass) : $testClass]);
        return $this;
    }
    
    /**
     * 
     * @param \NeoPh_Result $result
     * @return \NeoPh Description
     */
    public function addResult(NeoPh_Result $result) {
        return $this;
    }
}