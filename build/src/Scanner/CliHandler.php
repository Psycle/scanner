<?php

class Scanner_CliHandler implements Scanner_Output_Interface {

    public $streamPath = 'php://stdout';
    protected $_outputStream;

    /**
     *
     * @var Scanner_Option_Interface
     */
    protected $_optionInterface;
    protected $_colourClass;
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
        'extension' => array(
            'default' => 'php',
            'required' => true,
            'shortname' => 'e',
            'description' => 'The file extension to be scanned'
        ),
    );

    public function __construct(Scanner_Option_Interface $optionInterface) {
        $this->_optionInterface = $optionInterface;
        $this->_optionInterface->setup($this->_options);
        
    }

    public function getStreamResource() {
        if (is_null($this->_outputStream)) {
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
        if (is_null($this->_colourClass)) {
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