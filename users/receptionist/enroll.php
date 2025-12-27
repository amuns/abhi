<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php require "./header.php"; ?>
    <link rel="stylesheet" type="text/css" href="../../css/enroll.css">
</head>
<?php
    if(isset($_POST, $_POST['enroll'])){
        $stmt = $conn->prepare("UPDATE status SET status =:status");
        $stmt->execute([
            "status" => 1,
        ]);
    
        header("location: register.php");
        exit;
    }
?>
<body>
    <div class="container">
    <?php
        displaySidebar($links);
        displayDashboard();
        ?>
        <div class="body-section enroll-section">
            <div class="enroll-modal">
                <div class="enroll-header">
                    <h2 class="enroll-title">Add Fingerprint</h2>
                </div>
                
                <div class="enroll-content">
                    <p class="enroll-instructions">
                        Press the button below and ask the patient to place their finger on the sensor. After the sensor has sent the ID, <strong>press reload</strong>.
                    </p>
                    
                    <?php flashMessages(); ?>
                    
                    <div class="biometric-icon-wrapper">
                        <?php if (isset($_SESSION['error'])) : ?>
                            <img src="../img/fingerprint-notfound-icon.png" alt="Fingerprint not found" class="biometric-icon">
                        <?php else : ?>
                            <img src="../img/fingerprint-icon.png" alt="Fingerprint" class="biometric-icon">
                        <?php endif; ?>
                    </div>
                    
                    <div class="biometric-label">Fingerprint Scanner</div>
                    
                    <form action="enroll.php" method="POST" class="enroll-form">
                        <button type="submit" name="enroll" class="enroll-btn primary-btn">Add Fingerprint</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- div:dashboard-wrapper closing -->
    </div>

</body>

</html>