<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require "./header.php"; ?>
</head>

<body>
    <div class="container">
        <?php
        displaySidebar($links);
        displayDashboard();
        ?>

        <div class="body-section">
            <h3>Your appointment</h3>
            <?php
            $user_id = $_SESSION['userInfo']['id'];
            $stmt = $conn->query("SELECT patient_id from appointments WHERE user_id = $user_id ORDER BY created_at DESC");
            $stmt->execute();
            $patientId = $stmt->fetch();
            echo $patientId['patient_id'] ?? 'null';
            $stmt = $conn->query("SELECT *, TIMESTAMPDIFF(YEAR, dob, CURDATE()) as age from patient_details WHERE id=" . $patientId['patient_id']);
            $stmt->execute();
            $patientDetails = $stmt->fetch();
            ?>
            <div class="view-section">
                <?= flashMessages() ?>
                <div class="patient-details">
                    <h4>Patient Details</h4>
                    <div style="position: relative">
                        <img src="../img/defUser.jpeg">
                        <p class="details">
                            <span><?= $patientDetails['fname'] ?></span><br><br>
                            <span><?= $patientDetails['address'] ?></span><br><br>
                            <span><?= $patientDetails['phone'] ?></span><br><br>
                            <span><?= $patientDetails['age'] ?></span><br><br>
                            <span><?= $patientDetails['gender'] ?></span><br><br>
                        </p>
                        <a href="patient-history.php?pid=<?= $patientDetails['id'] ?>">View History</a>
                    </div>
                </div>
                <div class="register-details">
                    <form method="POST" action="index.php">
                        <input type="text" name="diseases" placeholder="Diseases">
                        <input type="text" name="rbc_count" placeholder="RBC Count">
                        <input type="text" name="wbc_count" placeholder="WBC Count">
                        <input type="text" name="blood_group" placeholder="Allergies">
                        <input type="" name="email" placeholder="Blood Group">
                        <div class="two-columns">
                            <input type="text" name="advised_tests" placeholder="Advised Tests">
                            <select name="test_status">
                                <option disabled>--Test Status--</option>
                                <option value="parents">Pending</option>
                                <option value="spouse">Done</option>
                            </select>
                        </div>
                        <div class="two-columns">
                            <input type="text" name="symptoms" placeholder="Symptoms">
                            <input type="text" name="diagnosis" placeholder="Diagnosis">
                            <input type="text" name="prescriptions" placeholder="Prescriptions">
                            <input type="text" name="prescribed_medicines" placeholder="Prescribed Medicines">
                        </div>

                        <input class="image-upload" type="file" name="dp">

                        <button type="submit" class="display-block-center">Create New Patient</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- dashboard:wrapper closing -->
    </div>
</body>

</html>