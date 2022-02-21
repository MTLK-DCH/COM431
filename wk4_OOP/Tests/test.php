<?php
// //Class definition
// class greeting{
//     public $str = "Hello World!";

//     function show_greeting(){
//         return $this->str;
//     }
// }

// // Create object from class
// $message = new greeting;
// var_dump($message)


// $str = fgets(STDIN);
// $a = (int)$str;
// print $a;


// $testarray = [];
// $testarray[] = "a";
// $testarray[] = "a";
// $testarray[] = "a";
// foreach($testarray as $x){
//     echo $x;
// }


// $name = fgets(STDIN);
// delete the newline mark at the end of string
// $name = "a;ldfj;alf";
// echo "原字符串". $name. "\n";
// $name = substr($name, 0, -1);
// echo "处理完". $name. "\n";

$name = fgets(STDIN);
echo "原字符串". $name. "\n";
$name = substr($name, 0, -1);
echo "处理完". $name. "\n";
?>