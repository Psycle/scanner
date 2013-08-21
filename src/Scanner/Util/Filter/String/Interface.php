<?php
interface Scanner_Util_Filter_String_Interface {
    
    /**
     * 
     * @param string $word
     */
    public function underscore($word);

    /**
     * 
     * @param string $word
     */
    public function camelize($word);
}