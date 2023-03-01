<?php 
    session_start();

    require "./utils.php";
    require "./pdo.php";
    
    
    if(!isset($_SESSION['userInfo']) && $_SESSION['userInfo']['role'] !== "FRESPONDER"){
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
            <h2>Welcome! <?= $_SESSION['userInfo']['name']?></h2>
        </div>
    </div>

</body>

</html>