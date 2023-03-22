<?php
@session_start();
require "./utils.php";
require "./pdo.php";


?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/app.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Log In</title>
</head>

<body>
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">

                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form method="POST" action="register-process.php">
                        
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
                                <label class="form-label" for="form3Example3">address</label>
                            </div>
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="email" name="email" id="form3Example3" class="form-control form-control-lg" placeholder="Enter a valid email address" required />
                                <label class="form-label" for="form3Example3">Email address</label>
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-3">
                                <input type="password" name="password" id="form3Example4" class="form-control form-control-lg" placeholder="Enter password" required />
                                <label class="form-label" for="form3Example4">Password</label>
                            </div>

                            <div class="text-center text-lg-start mt-4 pt-2">
                                <button type="submit" class="btn btn-primary btn-lg" onclick="location.href='./enroll.php'" style="padding-left: 2.5rem; padding-right: 2.5rem;">Enroll Fingerprint</button>

                                <!-- <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="#!" class="link-danger">Register</a></p> -->
                            </div>
                            <br>


                            <div class="text-center text-lg-start mt-4 pt-2">
                                <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Register</button>
                                <!-- <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="#!" class="link-danger">Register</a></p> -->
                                <button type="submit" class="btn btn-primary btn-lg" onclick="location.href='./login.php'" style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
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
</body>

</html>