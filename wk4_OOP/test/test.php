<?php
//Class definition
class greeting{
    public $str = "Hello World!";

    function show_greeting(){
        return $this->str;
    }
}

// Create object from class
$message = new greeting;
var_dump($message)
?>