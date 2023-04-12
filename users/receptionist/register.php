<?php
include "./verify-block.php";

if (isset($_POST, $_POST['fname'], $_POST['lname'], $_POST['age'], $_POST['address'])) {
    $fname = validate($_POST['fname']);
    $lname = validate($_POST['lname']);
    $age = validate($_POST['age']);
    $address = validate($_POST['address']);
    $email = validate($_POST['email']);

    if (isset($_FILES['dp'])) { //If block to be commented out if any error occurs
        $dir = "../uploads";
        if (!is_dir($dir)) {
            mkdir($dir, 0777);
        }
        $target_file = $dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // echo $target_file. " ". $imageFileType; exit;
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "gif" && $imageFileType != "jpeg") {
            $_SESSION['error'] = "[400] File type not allowed!";
            header("location: register.php");
            exit;
        }

        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $_SESSION['error'] = "[400] File not uploaded!";
            header("location: register.php");
            exit;
        }

        //If any error occurs please move the block i.e. line 34-42 out of the this if statement and comment out the if statement for $_FILES
        //Delete the image=:image if error occurs
        $stmt1 = $conn->prepare("UPDATE patient_details SET fname=:fname, lname=:lname, age=:age, address=:addr, email=:email, image=:image WHERE id=" . $_SESSION['id']);
        $stmt1->execute([
            'fname' => $fname,
            'lname' => $lname,
            'age' => $age,
            'addr' => $address,
            'email' => $email,
            'image' => $_FILES['dp']['name'], //Create an image column in the patient_details table || comment out if error occurs
        ]);
        unset($_SESSION['id']);
    }
}

$stmt = $conn->prepare("SELECT * from patient_details WHERE fname IS NULL");
$stmt->execute();
$rowCount = $stmt->rowCount();
$emptyData = $stmt->fetch();


?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../css/app.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style.css">

    <title>Receptionist</title>
</head>

<body>
    <?php
    if ($rowCount > 0) {
        $_SESSION['id'] = $emptyData['id'];
        echo "<script>alert('Continue?')</script>";
    ?>

        <section class="vh-100">

            <div class="container-fluid h-custom">
                <div class="row d-flex justify-content-center align-items-center h-100">

                    <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                        <form method="POST" action="register.php">

                            <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                                <p class="lead fw-normal mb-0 me-3">Register</p>

                                <?= flashMessages(); ?>

                                <div class="form-outline mb-4">
                                    <input type="text" name="fname" id="form3Example3" class="form-control form-control-lg" placeholder="Enter your first name" required />
                                    <label class="form-label" for="form3Example3">First Name</label>
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="text" name="lname" id="form3Example3" class="form-control form-control-lg" placeholder="Enter your last name" required />
                                    <label class="form-label" for="form3Example3">Last Name</label>
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="number" name="age" id="form3Example3" class="form-control form-control-lg" placeholder="Enter your age" required />
                                    <label class="form-label" for="form3Example3">Age</label>
                                </div>
                                <div class="form-outline mb-4">
                                    <input type="text" name="address" id="form3Example3" class="form-control form-control-lg" placeholder="Enter your address" required />
                                    <label class="form-label" for="form3Example3">Address</label>
                                </div>
                                <!-- Email input -->
                                <div class="form-outline mb-4">
                                    <input type="email" name="email" id="form3Example3" class="form-control form-control-lg" placeholder="Enter a valid email address" required />
                                    <label class="form-label" for="form3Example3">Email address</label>
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="file" name="dp" id="form3Example3" class="form-control form-control-lg" required />
                                    <label class="form-label" for="form3Example3">Display Picture</label>
                                </div>
                                <br>


                                <div class="text-center text-lg-start mt-4 pt-2">
                                    <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Register</button>
                                    <!-- <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="#!" class="link-danger">Register</a></p> -->
                                </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
                <!-- Copyright -->
                <!-- <div class="text-white mb-3 mb-md-0">
                Copyright © 2020. All rights reserved.
            </div> -->
                <!-- Copyright -->

                <!-- Right -->
                <!-- <div>
                <a href="#!" class="text-white me-4">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#!" class="text-white me-4">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#!" class="text-white me-4">
                    <i class="fab fa-google"></i>
                </a>
                <a href="#!" class="text-white">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            </div> -->
                <!-- Right -->
            </div>



        </section>
    <?php
    } else {
    ?>
        <a href="./index.php">Home</a><br><br>
        <a href="./logout.php">Logout</a><br><br>
    <?php

        echo "<a href='enroll.php'>Enroll Fingerprint</a>";
    }
    ?>
</body>

</html>