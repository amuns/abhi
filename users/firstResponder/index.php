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
    <style>
        td.empty-list {
            text-align: center;
        }

        table{
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background: rgb(0, 0, 0, 0.6);
            color: white;
        }
    </style>
</head>

<body>
    <?php
    include "./navbar.php";
    ?>
    <div class="area">

        <div class="content">
            
            <h2>Welcome! <?= $_SESSION['userInfo']['name'] ?></h2>

            <h3>Your Listings</h3>

            <form action="index.php">
                Search: <input type="text" name="search-field" placeholder="Search status">
                <input type="submit" value="Search">
            </form>
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
                // $result = "";
                // $number_of_results = "";
                $results_per_page = 3;

                if (isset($_GET['search-field'])) {
                    $s = $_GET['search-field'];
                    $sql = "SELECT * from patient_injuries_desc WHERE status LIKE '%$s%'";
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
                                echo "<li>" . ucfirst($title[0]['title']) . "</li>";
                            }
                            echo "</ul>";
                        } else {
                            echo "No Data Found.";
                        }
                        echo "</td>";
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

</body>

</html>