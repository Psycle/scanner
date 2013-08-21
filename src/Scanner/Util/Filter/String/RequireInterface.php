<?php

interface Scanner_Util_Filter_String_RequireInterface {
    
    /**
     * 
     * @param Scanner_Util_Filter_String_Interface $stringInterface
     */
    public function setStringFilterInterface(Scanner_Util_Filter_String_Interface $stringInterface);
    
    /**
     * @return Scanner_Util_Filter_String_Interface
     */
    public function getStringFilterInterface();
}