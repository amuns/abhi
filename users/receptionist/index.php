<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php require './header.php'; ?>
</head>
<?php
$sql = "SELECT * from patient_details";

if (isset($_POST, $_POST['search'])) {
    $s = $_POST['search'];
    $sql = "SELECT * FROM patient_details WHERE fname LIKE '%$s%'";
}

if(isset($_POST, $_POST['doctor_id'], $_POST['patient_id'])){
    $doctorId = $_POST['doctor_id'];
    $patientId = $_POST['patient_id'];
    $stmt = $conn->prepare("INSERT into appointments(user_id, patient_id, status) VALUES(:user_id, :patient_id, :status)");
    $stmt->execute([
        'user_id' => $doctorId,
        'patient_id' => $patientId, 
        'status' => 'pending'
    ]);
    $_SESSION['success'] = "Doctor assigned";
    header("location: index.php");
    exit;
}
?>

<body class="patients-page">
    <div class="container">
        <?php
        displaySidebar($links);
        displayDashboard();
        ?>

        <div class="patients-main">
            <div class="patients-card">
                <div class="patients-card-header">
                    <div class="patients-card-title">
                        <h2>Patients</h2>
                        <p>Review patient details, assign doctors, and manage next visits.</p>
                    </div>
                    <div class="patients-toolbar">
                        <form action="index.php" method="POST" class="patients-search-form">
                            <div class="patients-search-input">
                                <i class="ri-search-line"></i>
                                <input type="text" name="search" placeholder="Search patient">
                            </div>
                        </form>
                        <button type="button" class="btn add-button" onclick="window.location.href='enroll.php'">
                            + Add Patient
                        </button>
                    </div>
                </div>

                <div class="patients-table-wrapper">
                    <?php
                    flashMessages();
                    $stmt = $conn->query($sql);
                    $stmt->execute();
                    $patientDetails = $stmt->fetchAll();
                    ?>

                    <?php if ($stmt->rowCount() > 0): ?>
                        <table class="patients-table">
                            <thead>
                                <tr>
                                    <th>Patient</th>
                                    <th>Gender</th>
                                    <th>Primary Condition</th>
                                    <th>Care Plan</th>
                                    <th>Care Team</th>
                                    <th>Last Visit Date</th>
                                    <th>Next Visit Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($patientDetails as $patient): ?>
                                <tr class="patient-row" data-patient-id="<?=$patient['id']?>">
                                    <td>
                                        <div class="patient-cell">
                                            <div class="patient-avatar">
                                                <img src="../uploads/<?=$patient['dp'] ?? 'defUser.jpeg'?>" alt="Patient">
                                            </div>
                                            <div class="patient-meta">
                                                <div class="patient-name"><?=$patient['fname']?></div>
                                                <div class="patient-sub"><?=$patient['address'] ?? '-'?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="pill pill-muted">
                                            <?= $patient['gender'] ? ucfirst($patient['gender']) : '-' ?>
                                        </span>
                                    </td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td class="patients-actions">
                                        <div class="row-action" data-patient-id="<?=$patient['id']?>">
                                            <button type="button" class="kebab-btn" aria-label="Patient actions">
                                                <i class="ri-more-2-fill"></i>
                                            </button>
                                            <div class="row-action-menu">
                                                <button type="button" class="row-menu-item assign-doctor-trigger">
                                                    <i class="ri-user-heart-line"></i>
                                                    <span>Assign doctor</span>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p class="patients-empty-state">No patients found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- div:dashboard-wrapper closing -->
    <div></div>

    <script src="assign-doctor-modal.js"></script>
</body>
</html>