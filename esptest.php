<?php

// establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "abhi";

$conn = new mysqli($servername, $username, $password, $dbname);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$fid = $_GET['Fingerprint_Id'];
// prepare SQL query
$sql = "INSERT patient_details (description, created_at, fingerprint_id)
        VALUES ('this is a fingerprint test esp', NOW(), $fid)";

// execute SQL query
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// close database connection
$conn->close();

?>
