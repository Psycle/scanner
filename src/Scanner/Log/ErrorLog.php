<?php

class Scanner_Log_ErrorLog implements Scanner_Log_Interface {
    
    const LEVEL_ERROR = E_ERROR;
    const LEVEL_DEBUG = E_NOTICE;
    const LEVEL_INFO = E_NOTICE;
    
    public function error($message) {
        $this->log($message, self::LEVEL_ERROR);
    }
    
    public function debug($message) {
        $this->log($message, self::LEVEL_DEBUG);
    }
    
    public function info($message) {
        $this->log($message, self::LEVEL_INFO);
    }
    
    public function log($message, $level) {
        error_log($message, $level);
    }
}