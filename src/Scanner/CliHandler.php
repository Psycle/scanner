<?php

class Scanner_CliHandler extends Scanner_CliHandler_Abstract implements Scanner_Output_Interface {
    
    /**
     *
     * @var Scanner_Option_Interface
     */
    protected $_optionInterface;

    /**
     *
     * @var array 
     */
    protected $_options = array(
        'alltests' => array(
            'switch' => true,
            'default' => true,
            'shortname' => 'a',
        ),
        'test' => array(
            'shortname' => 't',
            'require' => array(
                'longword',
                'entropy',
            ),
        ),
        'path' => array(
            'shortname' => 'p',
            'required' => true,            
        ),
        'extension' => array(
            'default' => 'php',
            'required' => true,
            'shortname' => 'e',
            'description' => 'The file extension to be scanned'
        ),
    );

    /**
     * 
     * @param Scanner_Option_Interface $optionInterface
     */
    public function __construct(Scanner_Option_Interface $optionInterface) {
        $this->_optionInterface = $optionInterface;
        $this->_setupOptions();
        $this->_optionInterface->setup($this->_options);
        
    }
    
    /**
     * Sets up the options with default values etc.
     */
    protected function _setupOptions() {
        $this->_options['path']['default'] = getcwd();
    }


    public function run() {
        try {
            $this->_run();
        } catch (Scanner_CliHandler_Option_Exception $e) {
            $this->outputError($e->getMessage() . PHP_EOL);
            $this->outputUsage();
        }
    }

    protected function _run() {
        $this->_optionInterface->init();
        if ($this->_optionInterface->getOption('alltests', false)) {
            $this->_runAllTests();
        } else if ($this->_optionInterface->getOption('test', false) != false) {
            $this->_runTest($this->_optionInterface->getOption('test', false));
        } else {
            $this->outputUsage();
        }
    }

    protected function _runTest() {
        
    }
    
    public function outputUsage() {
        $this->output('Usage: ' . basename($_SERVER['PHP_SELF']) . ' --alltests --path=TARGET_PATH' . PHP_EOL);
        $this->output('Options:');
        $this->output($this->_optionInterface->getDocumentation());
    }

}