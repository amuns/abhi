<?php
session_start();
require "./pdo.php";
require "./utils.php";


/* if($status[0]==1){
        echo $status[0];
    } */
// $status[0]['status']
if (isset($_SESSION['status']) && !empty($_SESSION['status'])) {
    if ($_SESSION['status'] == 0) {
        echo $_SESSION['status'];
        $fid = $_GET['fid'];
        $sql = "UPDATE patient_details SET fingerprint_id = $fid WHERE id = ".$conn->lastInsertId();
        
        if ($conn->query($sql) === TRUE) {
            $_SESSION['success'] = "You are Registered Successfullly!";
            header("location: login.php");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->errorInfo();
            echo "done";
        }
    }
}
