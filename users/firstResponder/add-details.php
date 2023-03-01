<?php
session_start();

require "./utils.php";
require "./pdo.php";


if (!isset($_SESSION['userInfo']) && $_SESSION['userInfo']['role'] !== "FRESPONDER") {
    $_SESSION['error'] = "[403] Access Denied!";
    header("location: ../../login.php");
}

// debug($_SESSION['userInfo']['name']);
?>

<html>

<head>
    <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
    <?php include "./header.php"; ?>
</head>

<body>
    <?php
    include "./navbar.php";
    ?>
    <div class="area">
        <div class="content">
            <h2>Add Details</h2>
            <form action="add-details.php" method="post">
                
            </form>
        </div>
    </div>

</body>

</html>