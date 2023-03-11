<?php
require './pdo.php';
require "./utils.php";

//insert admin in Database
/* $stmt = $conn->prepare("INSERT INTO users(email, name, password, role) VALUES(:email, :name, :password, :role)");

try {
    $stmt->execute(array(
        "email" => "admin@example.com",
        "password" => password_hash("admin123", PASSWORD_DEFAULT),
        "name" => "Admin",
        "role" => "ADMIN"
    ));
} catch (Exception $th) {
    echo $th;
    echo $conn->errorInfo();
} */

/* $stmt = $conn->prepare("INSERT INTO users(email, name, password, role) VALUES(:email, :name, :password, :role)");

try {
    $stmt->execute(array(
        "email" => "first@responder.com",
        "password" => password_hash("first123", PASSWORD_DEFAULT),
        "name" => "First Responder",
        "role" => "FRESPONDER"
    ));
} catch (Exception $th) {
    echo $th;
    echo $conn->errorInfo();
} */

/* $stmt = $conn->prepare("INSERT INTO patient_injuries_desc(description, status) VALUES(:desc, :status)");

 try {
    $stmt->execute(array(
        "desc" => "First Patient",
        "status" => "First Patient"
    ));
} catch (Exception $th) {
    echo $th;
    echo $conn->errorInfo();
} */
?>
