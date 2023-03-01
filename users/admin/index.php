<?php 
    session_start();

    require "../../utils.php";
    require "../../pdo.php";
    
    
    if(!isset($_SESSION['userInfo']) && $_SESSION['userInfo']['role'] !== "ADMIN"){
        $_SESSION['error'] = "[403] Access Denied!";
        header("location: ../../login.php");
    }
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
    <h2>Welcome! <?=$_SESSION['userInfo']['name']?></h2>


</body>

</html>