<?php
require "../pdo.php";
// require ".utils.php";

$stmt = $conn->query("SELECT * from status LIMIT 1");

$data = $stmt->fetch();

echo $data[0];

?>

