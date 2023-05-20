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
?>

<body>
    <div class="container">
        <?php
        displaySidebar($links);
        displayDashboard();
        ?>

        <div class="search-bar">
            <form action="index.php" method="POST">
                <input type="text" name="search" size="30" placeholder="Search Patient">
                <button type="submit" class="search-button">
                    <img src="../img/search.png">
                </button>
            </form>
        </div>

        <div class="body-section">
            <h3>Patient List</h3>
            <div class="list-wrapper">
                <?php
                $stmt = $conn->query($sql);
                $stmt->execute();
                $patientDetails = $stmt->fetchAll();
                ?>

                <div class="list <?php echo $stmt->rowCount() > 5? 'list-start-animation' : ''; ?>">
                    <?php
                    if ($stmt->rowCount() > 0) {
                       /*  echo "<pre>";
                        print_r($patientDetails);
                        echo "</pre>"; */
                        foreach($patientDetails as $patient){
                    ?>
                    <div class="list-item">
                        <div><img style="border-radius: 50%; height: 5rem;" src="../img/defUser.jpeg"></div>
                        <div style="width: 15rem;"><?=$patient['fname']?></div>
                        <div style="width: 18rem;"><?=$patient['address']??'-'?></div>
                        <div style="width: 10rem;"><?=$patient['phone']??'-'?></div>
                        <div class="dropdown">
                            Assign Doctor
                            <div class="dropdown-content">
                                <?php
                                $stmt1 = $conn->query("SELECT id, name FROM users WHERE role='DOCTOR'");
                                $stmt1->execute(); 
                                $doctors = $stmt1->fetchAll();
                                if($stmt1->rowCount() > 0){
                                    foreach($doctors as $doc){
                                ?>
                                <form action="index.php" class="dropdown-form" method="POST">
                                    <input type='hidden' value="<?=$doc['id']?>">
                                    <button type="submit"><?=$doc['name']?></button>
                                </form>
                                <?php
                                    }
                                }
                                else{
                                    echo "No Doctors";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    } else {
                        echo "No data found!";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- div:dashboard-wrapper closing -->
    <div>
</body>

</html>