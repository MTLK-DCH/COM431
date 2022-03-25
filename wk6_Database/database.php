<?php

$db = new mysqli('db', 'root', 'password', 'docker_php');
$sql = "Select * from players";
$result = $db->query($sql);

while ($row = $result->fetch_assoc()){
    foreach($row as $key=>$value){
        echo $key . ": " .$value . "<br/>";
    }
}


// query items as object
$result = $db->query($sql);
while ($obj = $result->fetch_object()){
    echo "id: ". $obj->id. "<br/>";
    echo "name: ". $obj->name. "<br/>";
    echo "age: ". $obj->age. "<br/>";
}
$db->close();