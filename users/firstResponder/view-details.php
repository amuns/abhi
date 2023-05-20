<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php require './header.php'; ?>
</head>
<?php
$stmt = $conn->query("SELECT fid from retrieve_fingerprint");
$stmt->execute();
$fid = $stmt->fetch();

/* if ($stmt->rowCount() <= 0) {
    $_SESSION['error'] = 'Fingerprint not found';
    header('location: scan-patient.php');
    exit;
} */
?>


<body>
    <div class="container">
        <?php
        displaySidebar($links);
        displayDashboard();
        ?>

        <div class="body-section">
            <?php
            if (!isset($fid[0])) {
            ?>
                <div class="fingerprint-registering">
                    <h3>Fingerprint registering...</h3>
                    <img src="../img/spinner.gif">
                    <p>Kindly refresh the page after few minutes!</p>
                </div>
            <?php
            } else {
            ?>
                <?php
                $stmt = $conn->query("SELECT * from patient_details WHERE fingerprint_id =" . $fid[0]);
                $stmt->execute();
                $patientDetails = $stmt->fetch();

                if ($stmt->rowCount() <= 0) {
                    header("location: new-patient.php");
                    exit;
                } else {
                ?>
                    <div class="view-section">
                        <?php
                            debug($patientDetails);
                        ?>
                    </div>
                <?php
                }
                ?>
        </div>
    </div>

    <!-- Closing for div:dashboard-wrapper -->
    </div>
<?php
            }
?>
</body>

</html>