<?php
    require "./pdo.php";
    require "./utils.php";
  
    $result = $conn->query("SELECT status from fingerprint where status=0");
    $result->execute();
    $status = $result->fetch();
    /* if($status[0]==1){
        echo $status[0];
    } */
    // $status[0]['status']
    echo $status[0];
    

    
?>