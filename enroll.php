<?php
session_start();
require "./pdo.php";
require "./utils.php";

echo "0";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "abhi";

$conn = new mysqli($servername, $username, $password, $dbname);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$fid = $_GET['fid'];
// prepare SQL query

$sql = "INSERT into fingerprint(fid) VALUES($fid)";

// execute SQL query
if ($conn->query($sql) === TRUE) {
    echo "Fingerprint added successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// close database connection
$conn->close();
?>

