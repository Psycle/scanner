<?php
interface Scanner_Option_Interface {
    public function setOption($option, $value);
    public function getOption($option, $default = null);
    public function setOptions($options);
    public function getOptions();
    public function setup($config = null);
    public function getHelpText();
}