<?php

$db = new mysqli('db', 'root', 'password', 'docker_php');
$sql = "Select * from players";
$result = $db->query($sql);

while ($row = $result->fetch_assoc()){
    foreach($row as $key=>$value){
        echo $key . ": " .$value . "<br/>";
    }
}
$db->close();