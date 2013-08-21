<?php

abstract class Scanner_CliHandler_Option_Abstract extends ArrayIterator {
    protected $_options;

    public function __construct() {
        
    }
    
    public function setup($array = array()) {
        $this->_options = $array;        
    }

    abstract protected function _getRawOptions();

    public function init() {
        $options = $this->_getRawOptions();
        
        foreach ($this->_options AS $optionName => $option) {
            if (isset($option['shortname']) && isset($options[$option['shortname']])) {
                $options[$optionName] = $options[$option['shortname']];
                unset($options[$option['shortname']]);
            }
            if (isset($option['default']) && !isset($options[$optionName])) {
                $options[$optionName] = $option['default'];
            }
            if (isset($option['switch']) && $option['switch'] == true) {
                $options[$optionName] = $options[$optionName] != true;
            }

            if (isset($option['required']) && $option['required'] == true && !isset($options[$optionName])) {
                throw new Scanner_CliHandler_Option_Exception('--' . $optionName . ' is required');
            }

            if (isset($option['require']) && isset($options[$optionName])) {
                if (is_array($option['require'])) {
                    if (!in_array($options[$optionName], $option['require'])) {
                        throw new Scanner_CliHandler_Option_Exception('--' . $optionName . ' requires one of "' . implode(', ', $option['require']) . '"');
                    }
                } else {
                    if (!in_array($options[$optionName], $option['require'])) {
                        throw new Scanner_CliHandler_Option_Exception('--' . $optionName . ' requires "' . $option['require']);
                    }
                }
            }
        }

        $this->setOptions($options);
    }

    protected function _getShortOptions() {
        $optionsArray = array();
        foreach ($this->_options AS $optionName => $option) {
            $shortname = $this->getShortName($optionName);
            $required = isset($option['required']) ? (boolean) $option['required'] : false;
            $switch = isset($option['switch']) ? (boolean) $option['switch'] : false;
            if ($required) {
                $optionsArray[] = $shortname . ':';
            } elseif ($switch) {
                $optionsArray[] = $shortname;
            } else {
                $optionsArray[] = $shortname;
            }
        }

        return implode('', $optionsArray);
    }

    protected function _getLongOptions() {
        $optionsArray = array();
        foreach ($this->_options AS $optionName => $option) {
            $required = isset($option['required']) ? (boolean) $option['required'] : false;
            $switch = isset($option['switch']) ? (boolean) $option['switch'] : false;
            if ($required) {
                $optionsArray[] = $optionName . ':';
            } elseif ($switch) {
                $optionsArray[] = $optionName;
            } else {
                $optionsArray[] = $optionName . '::';
            }
        }

        return $optionsArray;
    }

    public function getOptions() {
        return $this;
    }

    public function setOptions($options) {
        foreach ($options AS $option => $value) {
            $this->setOption($option, $value);
        }
    }

    public function getOption($option, $default = null) {
        return isset($this[$option]) ? $this[$option] : $default;
    }

    public function setOption($option, $value) {
        $this[$option] = $value;
    }
    
    public function getDocumentation() {
        $docs = array();
        foreach ($this->_options AS $optionName => $option) {
            $description = isset($option['description']) ? $option['description'] : 'No description';
            
            $docs[] = sprintf('%1$s-%2$s, --%3$s%4$s%5$s', "\t", $this->getShortName($optionName), $optionName, str_repeat("\t", 4), $description);
        }
        
        return implode(PHP_EOL, $docs).PHP_EOL;
    }
    
    public function getShortName($optionName) {
        if(!isset($this->_options[$optionName]['shortname'])) {
            $this->_options[$optionName]['shortname'] = substr($optionName, 0, 1);
        }
        
        return $this->_options[$optionName]['shortname'];
    }
}