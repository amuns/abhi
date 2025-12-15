<?php
require_once '../../pdo.php';
session_start();

if(isset($_POST['doctor_id'], $_POST['patient_id'])){
    $doctorId = $_POST['doctor_id'];
    $patientId = $_POST['patient_id'];
    $stmt = $conn->prepare("INSERT into appointments(user_id, patient_id, status) VALUES(:user_id, :patient_id, :status)");
    $stmt->execute([
        'user_id' => $doctorId,
        'patient_id' => $patientId,
        'status' => 'pending'
    ]);
    echo json_encode(['success' => true]);
    exit;
}
echo json_encode(['success' => false]);

