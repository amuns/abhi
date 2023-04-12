<?php 
    include "./verify-block.php";

    $stmt=$conn->query("SELECT fid from retrieve_fingerprint");
    $stmt->execute();
    $fid = $stmt->fetch();

    if($stmt->rowCount() <= 0){
        echo "No data Found. Try Scanning fingerprint!"."<br>";
        echo "<a href='scan.php'>Scan Fingerprint</a>";
    }

    if(!isset($fid[0])){
        echo "Wait a minute. Fetching Fingerprint. Try reloading!";
    }
    else{
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php include "./header.php" ?>

</head>
<body>
    <?php include "./navbar.php" ?>    
    
    <div class="content">
        <?php
            $stmt = $conn->query("SELECT * from patient_details WHERE fingerprint_id =".$fid[0]);
            $stmt->execute();
            $patientDetails = $stmt->fetch();
            // debug($fid[0]);
            // debug($patientDetails['id']);

            if($stmt->rowCount() <= 0){
                echo "No records found! Kindly register!";
            }
            else{
        ?>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Address</th>
                <th>Age</th>
                <th>Email</th>
            </tr>
                    <tr>
                        <td><?=$patientDetails['id']?></td>
                        <td><?=$patientDetails['fname']?></td>
                        <td><?=$patientDetails['lname']?></td>
                        <td><?=$patientDetails['address']?></td>
                        <td><?=$patientDetails['age']?></td>
                        <td><?=$patientDetails['email']?></td>
    </tr>
        </table>
        <?php } ?>
    </div>
    
    <?php } ?>
</body>
</html>