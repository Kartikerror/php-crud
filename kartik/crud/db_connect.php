<?php
//Connecting to a database

$servername = "localhost";
$username = "root";
$password = "";
$database = "kartik";

$conn=mysqli_connect($servername,$username,$password,$database);
if($conn){
    echo "Connection is Successfull";
}

else{
    echo "Connection is not successfull Beacuse of this error:".mysqli_connect_error($conn);
}



?>