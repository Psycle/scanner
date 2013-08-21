<?php

interface Scanner_Output_Interface {
    public function output($string, $class = null);
    
    public function outputError($string);
    
    public function outputMessage($string);
    
    public function setStreamPath($path);
}