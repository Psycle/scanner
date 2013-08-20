<?php

interface Scanner_Output_Interface {
    public function output($string, $class);
    
    public function outputError($string);
    
    public function outputMessage($string);
    
}