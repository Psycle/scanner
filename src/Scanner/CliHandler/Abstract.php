<?php

abstract class Scanner_CliHandler_Abstract {
    
        public $streamPath = 'php://stdout';
        protected $_outputStream;
    
    	private $foreground_colors = array (
		  'black' => '0;30',
		  'dark_gray' => '1;30',
		  'blue' => '0;34',
		  'light_blue' => '1;34',
		  'green' => '0;32',
		  'light_green' => '1;32',
		  'cyan' => '0;36',
		  'light_cyan' => '1;36',
		  'red' => '0;31',
		  'light_red' => '1;31',
		  'purple' => '0;35',
		  'light_purple' => '1;35',
		  'brown' => '0;33',
		  'yellow' => '1;33',
		  'light_gray' => '0;37',
		  'white' => '1;37',
		);
		private $background_colors = array (
		  'black' => '40',
		  'red' => '41',
		  'green' => '42',
		  'yellow' => '43',
		  'blue' => '44',
		  'magenta' => '45',
		  'cyan' => '46',
		  'light_gray' => '47',
		);

 
		// Returns colored string
		public function getColoredString($string, $foreground_color = null, $background_color = null) {
			$colored_string = "";
 
			// Check if given foreground color found
			if (isset($this->foreground_colors[$foreground_color])) {
				$colored_string .= "\033[" . $this->foreground_colors[$foreground_color] . "m";
			}
			// Check if given background color found
			if (isset($this->background_colors[$background_color])) {
				$colored_string .= "\033[" . $this->background_colors[$background_color] . "m";
			}
 
			// Add string and end coloring
			$colored_string .=  $string . "\033[0m";
 
			return $colored_string;
		}
 
		// Returns all foreground color names
		public function getForegroundColors() {
			return array_keys($this->foreground_colors);
		}
 
		// Returns all background color names
		public function getBackgroundColors() {
			return array_keys($this->background_colors);
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
        $this->writeToOutput($this->getColoredString($string, $colour) . PHP_EOL);
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
}