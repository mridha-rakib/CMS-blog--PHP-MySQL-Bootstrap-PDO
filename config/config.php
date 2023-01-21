<?php


//host 
$host = "localhost";

//dbname
$dbname = "cleanblog";

//username
$username = "root";

//password
$pass = "";

$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $pass);

if ($conn == true) {
    echo "connection established";
} else {
    echo "connection failed";
}