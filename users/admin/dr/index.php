<?php
session_start();

require "./pdo.php";
require "../utils.php";

if (!isset($_SESSION['userInfo']) || $_SESSION['userInfo']['role'] !== "ADMIN") {
    $_SESSION['error'] = "[403] Access Denied!";
    unset($_SESSION['userInfo']);
    header("location: ../../../login.php");
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor CRUD</title>
    <style>
        .container {
            width: 80%;
            position: absolute;
            ;
            top: 10;
            left: 12%;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel="stylesheet" href="navbar.css">
</head>

<body>
    <?= include "./navbar.php" ?>

    <div class="area">
        <div class="container">
            <?php include './tab.php' ?>
            <div>
                <h2>Doctor Portal</h2>
                <?= flashMessages(); ?>
                <form action="index.php">
                    Search: <input type="text" name="search-field" placeholder="Search status">
                    <input type="submit" value="Search">
                </form>
                <br><br>
                <table border="1">
                    <tr>
                        <th>ID</th>
                        <th>Doctor Name</th>
                        <!-- <th>Status</th>
                        <th>Injuries</th>
                        <th>Image</th> -->
                        <th>Action</th>
                    </tr>

                    <?php
                    // $result = "";
                    // $number_of_results = "";
                    $results_per_page = 3;

                    if (isset($_GET['search-field'])) {
                        $s = $_GET['search-field'];
                        $sql = "SELECT * from users WHERE name LIKE '%$s%'";
                        $result = $conn->query($sql);
                        $number_of_results = $result->rowCount();
                    } else {
                        $sql = "SELECT * from patient_injuries_desc";
                        $result = $conn->query($sql);
                        $number_of_results  = $result->rowCount();
                    }

                    $number_of_page = ceil($number_of_results / $results_per_page);

                    if (!isset($_GET['page'])) {
                        $page = 1;
                    } else {
                        $page = $_GET['page'];
                    }

                    $page_first_result = ($page - 1) * $results_per_page;

                    $query = $sql . " LIMIT " . $page_first_result . ',' . $results_per_page;

                    $result = $conn->query($query);

                    if ($result->rowCount() <= 0) {
                        echo "<tr><td class='empty-list' colspan='6'>No data found!</td></tr>";
                    } else {

                        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
                        // debug($rows);
                        foreach ($rows as $row) {
                            echo "<tr>";
                    ?>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['description'] ?></td>
                            <td><?= ucfirst($row['status']) ?></td>
                            <?php
                            // $injuryData = $conn->query("SELECT * from users WHERE desc_id = " . $row['id']);
                            // debug($injuryData->rowCount());
                            /* echo "<td>";
                            if ($injuryData->rowCount() > 0) {
                                $injuries = $injuryData->fetchAll(PDO::FETCH_ASSOC);
                                echo "<ul>";
                                foreach ($injuries as $injury) {
                                    # code...
                                    $sql = $conn->query("SELECT title from injuries WHERE id = " . $injury['injury_id']);
                                    // debug($sql);
                                    $title = $sql->fetchAll(PDO::FETCH_ASSOC);
                                    // debug($title);
                                    echo "<li>" . ucfirst($title[0]['title']) . "</li>";
                                }
                                echo "</ul>";
                            } else {
                                echo "No Data Found.";
                            }
                            echo "</td>"; */
                            ?>
                            <td><img src="<?= '../uploads/' . $row['image'] ?>" alt="No Image Found." width="200px"></td>
                            <td>
                                <form action="editDetails.php" method="post" enctype="multipart/form-data">

                                    <input type="submit" value="Edit">
                                </form>
                            </td>
                    <?php
                        }
                        echo "</tr>";
                    }
                    for ($page = 1; $page <= $number_of_page; $page++) {
                        if (@$_GET['search-field']) {
                            $search = @$_GET['search-field'];
                            echo '<a href = "index.php?search-field=' . $search . '&&page=' . $page . '">' . $page . ' </a>';
                        } else {
                            echo '<a href = "index.php?page=' . $page . '">' . $page . ' </a>';
                        }
                    }
                    ?>
                </table>
            </div>


        </div>
    </div>
</body>

</html>