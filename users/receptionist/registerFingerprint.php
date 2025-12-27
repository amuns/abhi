<?php
declare(strict_types=1);

session_start();
require "../pdo.php";

// Debugging only; disable in production
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// 1) Validate input
if (!isset($_GET['fid'])) {
    http_response_code(400);
    echo "Missing required parameter: fid";
    exit;
}

$fid = filter_var($_GET['fid'], FILTER_VALIDATE_INT);
if ($fid === false || $fid <= 0) {
    http_response_code(400);
    echo "Invalid fid. Must be a positive integer.";
    exit;
}

try {
    // Optional: ensure correct database in case DSN lacks dbname
    // $conn->exec("USE `abhi`");

    // 2) Start transaction to keep inserts consistent
    if (!$conn->inTransaction()) {
        $conn->beginTransaction();
    }

    // 3) Insert into fingerprint
    // Ensure table/column exist: fingerprint(fid)
    $stmt = $conn->prepare("INSERT INTO `fingerprint` (`fid`) VALUES (:fid)");
    $stmt->bindValue(':fid', $fid, PDO::PARAM_INT);
    $stmt->execute();

    // 4) Insert into patient_details
    // Ensure table/column exist: patient_details(fingerprint_id)
    $stmt = $conn->prepare("INSERT INTO `patient_details` (`fingerprint_id`) VALUES (:fid)");
    $stmt->bindValue(':fid', $fid, PDO::PARAM_INT);
    $stmt->execute();

    // If patient_details has an auto-increment PK, lastInsertId refers to the last AUTO_INCREMENT value on this connection
    $_SESSION['lastInsertedId'] = $conn->lastInsertId();

    // 5) Update status table
    // If status table has multiple rows, you likely want a WHERE clause; without it, all rows will be updated.
    // Ensure table/column exist: status(status)
    $stmt = $conn->prepare("UPDATE `status` SET `status` = :status");
    $stmt->bindValue(':status', 0, PDO::PARAM_INT);
    $stmt->execute();

    // Commit transaction
    $conn->commit();

    echo "OK";
} catch (PDOException $e) {
    // Rollback if anything fails
    if ($conn->inTransaction()) {
        $conn->rollBack();
    }
    http_response_code(500);
    // Log detailed error, show generic message
    error_log("PDOException: " . $e->getMessage());
    echo "Database error.";
} catch (Throwable $e) {
    if ($conn->inTransaction()) {
        $conn->rollBack();
    }
    http_response_code(500);
    error_log("Unhandled error: " . $e->getMessage());
    echo "Unexpected server error.";
}