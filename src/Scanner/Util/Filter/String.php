<?php

class Scanner_Util_Filter_String implements Scanner_Util_Filter_String_Interface {

    public function underscore($word) {
        return preg_replace_callback('/(^|[a-z])([A-Z])/', array($this, 'underscoreCallback'), $word);     
    }

    public function underscoreCallback($val) {        
        return strtolower(strlen($val[1]) ? $val[1] . '_' . $val[2] : $val[2]);
    }
    
    public function camelizeCallback($val) {
        return strtoupper($val[2]);
    }
    
    public function camelize($word) {
        return preg_replace_callback('/(^|_)([a-z])/', array($this, 'camelizeCallback'), $word);
    }

}