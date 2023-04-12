<?php
session_start();

require "../../utils.php";
require "../../pdo.php";


if (!isset($_SESSION['userInfo']) || $_SESSION['userInfo']['role'] !== "ADMIN") {
    $_SESSION['error'] = "[403] Access Denied!";
    unset($_SESSION['userInfo']);
    header("location: ../../login.php");
}
?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <?php include "./header.php"; ?>
    <style>
        .content {
            width: 90%;
            position: absolute;
            top: 2%;
            left: 8%;
        }
    </style>
</head>

<body>
    <?php
    include "./navbar.php";
    ?>
    <div class="content">
        <h2>Welcome! <?= $_SESSION['userInfo']['name'] ?></h2>

    </div>


</body>

</html>