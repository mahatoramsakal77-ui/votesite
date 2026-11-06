<?php

$conn = mysqli_connect("localhost","root","","cms",3307);
if(!$conn){
    die("Error--- {$conn->connect->error()}");
}


?>