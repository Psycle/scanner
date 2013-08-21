<?php

class Scanner_Util_Filter_String implements Scanner_Util_Filter_String_Interface {

    public function underscore($word) {
        return preg_replace(
                '/(^|[a-z])([A-Z])/e', 'strtolower(strlen("\\1") ? "\\1_\\2" : "\\2")', $word
        );
    }

    public function camelize($word) {
        return preg_replace('/(^|_)([a-z])/e', 'strtoupper("\\2")', $word);
    }

}