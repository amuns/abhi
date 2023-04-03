<?php 
    session_start();
    
    require "./pdo.php";
    require "./utils.php";


    $stmt = $conn->prepare("UPDATE status SET status =:status");
    $stmt->execute([
        "status" => 0,
    ]);

    $fid = $_GET['fid'];

    $stmt = $conn->prepare("INSERT INTO fingerprint(fid) VALUES(:id)");
    $stmt->execute([
        'id' => $fid,
    ]);

    $stmt = $conn->prepare("INSERT INTO patient_details(fid) VALUES(:id)");
    $stmt->execute([
        'id' => $fid,
    ]);

    $_SESSION['fingerprint_id'] = $fid;
    

?>