<?php 
    $conn = new PDO("mysql:host=127.0.0.1; port=3306; dbname=abhi", "amun", "A@shri2017");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(!$conn){
        die("Database error!");
    }
    // else{
    //     echo "conn";
    // }

?>