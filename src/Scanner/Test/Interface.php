<?php

interface Scanner_Test_Interface {
    public function __construct(Scanner_Option_Interface $options, Scanner_Output_Interface $outputInterface, Scanner_Log_Interface $logger);
    public function run();
}