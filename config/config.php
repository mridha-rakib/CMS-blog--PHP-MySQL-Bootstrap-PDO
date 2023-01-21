<?php

try {
    //host 
    $host = "localhost";

    //dbname
    $dbname = "cleanblog";

    //username
    $username = "root";

    //password
    $pass = "";

    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}

// if ($conn == true) {
//     echo "connection established";
// } else {
//     echo "connection failed";
// }