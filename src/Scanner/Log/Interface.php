<?php

interface Scanner_Log_Interface {
    public function log($message, $level);
    
    public function debug($message);
    
    public function error($message);
    
    public function info($message);
}