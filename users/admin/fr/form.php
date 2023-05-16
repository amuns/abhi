<?php
session_start();
require "./pdo.php";
require "../utils.php";

if (!isset($_SESSION['userInfo']) || $_SESSION['userInfo']['role'] !== "ADMIN") {
    $_SESSION['error'] = "[403] Access Denied!";
    unset($_SESSION['userInfo']);
    header("location: ../../../login.php");
}

if (isset($_POST, $_POST['title'], $_POST['type'])) {
    $title = validate($_POST['title']);
    $type = $_POST['type'];

    try {
        $stmt = $conn->prepare("INSERT INTO fresponder_form(title, type) VALUES(:title, :type)");
        $stmt->execute([
            'title' => $title,
            'type' => $type
        ]);

        $stmt = $conn->prepare("SHOW columns from 'patient_details' LIKE '$title'");
        if($stmt->rowCount() <= 0){
            $sql = "ALTER TABLE patient_details add column $title varchar(255)";
            $stmt1 = $conn->prepare($sql);
            $stmt1->execute();
        }

        $_SESSION['success'] = "Field added to from";
        header('location: form.php');
        exit;
    } catch (Exception $e) {
        $_SESSION['error'] = "Oops! Error occured!";
        $_SESSION['error'] = $e;
        header('location: form.php');
        exit;
    }
}

if (isset($_POST, $_POST['id'], $_POST['delete'])) {
    $id = $_POST['id'];
    $stmt = $conn->prepare("DELETE FROM fresponder_form WHERE id=:id");

    try {
        $stmt->execute(array(':id' => $id));
        $_SESSION['error'] = "Field was removed!";
        header("location: form.php");
        exit;
    } catch (PDOException $e) {
        $_SESSION['error'] = "Invalid Request";
        header("location: form.php");
        exit;
    }
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form CRUD</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel="stylesheet" type="text/css" href="./navbar.css">
    <style>
        .container {
            width: 80%;
            position: absolute;
            top: 10px;
            left: 12%;
        }

        li.actionsList {
            display: inline-block;
            width: 55px;
            font-size: 20px;
            color: #eeeeee;
            position: relative;
            left: -1.3rem;
            top: 1rem;
        }

        td {
            text-align: center;
        }

        table {
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

        tr th {
            text-align: center;
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

        input[type="submit"] {
            background-color: #337ab7;
            color: white;
            height: 2.5rem;
            width: 4rem;
            border-radius: 6px;
            border: none;
        }

        input[type="submit"]:hover {
            background-color: #286090;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php include "./navbar.php"; ?>

    <div class="area">
        <div class="container">
            <?php include "./tab.php"; ?>

            <h2>Add Field to First Responder form</h2>
            <?= flashMessages(); ?>
            <form action="form.php" method="post">
                <input type="text" id="title" name="title" placeholder="Title" required>
                <select name="type">
                    <option disabled>Select type</option>
                    <option value="text">Text</option>
                    <option value="number">Number</option>
                    <option value="email">Email</option>
                </select>
                <br><br>
                <input type="submit" value="Add">
            </form> <br><br>

            <h2>Field list</h2>

            <table border="1">
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
                <?php
                $result = $conn->query("SELECT * from fresponder_form ORDER BY id DESC");
                if ($result->rowCount() > 0) {
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>$row[id]</td><td>$row[title]</td>";
                        echo "<td>$row[type]</td>";
                ?>
                        <td>
                            <ul>

                                <li class="actionsList">
                                    <form action="form.php" method="post">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <input type="submit" name="delete" value="Delete">
                                    </form>
                                </li>
                            </ul>


                        </td>
                <?php
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan=\"4\">No Records Found.</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>

</body>

</html>