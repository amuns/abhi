<?php
require_once '../../pdo.php';
header('Content-Type: application/json');
$stmt = $conn->query("SELECT id,name FROM users WHERE role='DOCTOR'");
$doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($doctors);

