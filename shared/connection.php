<?php
$conn=new mysqli("localhost","root","","ecomweb");
if($conn->connect_error){
    echo "SQL Connection Failed";
    die;
}
?>