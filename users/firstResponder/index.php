<?php
session_start();

require "./utils.php";
require "./pdo.php";

// debug($_SESSION['userInfo']);exit;
if (!isset($_SESSION['userInfo']) || $_SESSION['userInfo']['role'] !== "FRESPONDER") {
    $_SESSION['error'] = "[403] Access Denied!";
    unset($_SESSION['userInfo']);
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
            <h2>Welcome! <?= $_SESSION['userInfo']['name'] ?></h2>
            <br><br>
            <h3>Your Listings</h3>
            <!-- <img src="../uploads/1.png"> -->
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Injuries</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>

                <?php
                $result = $conn->query("SELECT * from patient_injuries_desc");
                $rows = $result->fetchAll(PDO::FETCH_ASSOC);
                // debug($rows);
                foreach ($rows as $row) {
                    echo "<tr>";
                ?>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['description'] ?></td>
                    <td><?= ucfirst($row['status']) ?></td>
                    <?php
                    $injuryData = $conn->query("SELECT * from patient_injuries WHERE desc_id = " . $row['id']);
                    // debug($injuryData->rowCount());
                    echo "<td>";
                    if ($injuryData->rowCount() > 0) {
                        $injuries = $injuryData->fetchAll(PDO::FETCH_ASSOC);
                        echo "<ul>";
                        foreach ($injuries as $injury) {
                            # code...
                            $sql = $conn->query("SELECT title from injuries WHERE id = " . $injury['injury_id']);
                            // debug($sql);
                            $title = $sql->fetchAll(PDO::FETCH_ASSOC);
                            // debug($title);
                            echo "<li>".ucfirst($title[0]['title'])."</li>";
                            
                            
                        }
                        echo "</ul>";
                    }
                    else{
                        echo "No Data Found.";
                    }
                    echo "</td>";
                        ?>
                    <td><img src="<?='../uploads/'.$row['image']?>" alt="No Image Found." width="200px"></td>
                <?php
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>

</body>

</html>