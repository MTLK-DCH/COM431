<?php
if(isset($_POST['submit'])){
    echo "Your age is ${_POST['age']}";
} else {
    echo "you didn't submit a form";
}
?>