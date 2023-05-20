<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php require "./header.php"; ?>
</head>
<?php
if (isset($_POST, $_POST['fname'], $_POST['phone'], $_POST['dob'], $_POST['address'], $_POST['ephone'], $_POST['relation'], $_POST['gender'])) {
    $fname = validate($_POST['fname']);
    $phone = validate($_POST['phone']);
    $dob = validate($_POST['dob']);
    $address = validate($_POST['address']);
    $email = validate($_POST['email']);
    $ephone = validate($_POST['ephone']);
    $relation = validate($_POST['relation']);
    $gender = validate($_POST['gender']);
    $image = "";

    $phone_pattern = "/^9[0-9]{9}$/";

    if(!preg_match($phone_pattern, $phone) || !preg_match($phone_pattern, $ephone)){
        $_SESSION['error'] = "Invalid contact number!";
        header('location: register.php');
        exit;
    }

    if (isset($_FILES['dp'])) { //If block to be commented out if any error occurs
        $dir = "../uploads";
        if (!is_dir($dir)) {
            mkdir($dir, 0777);
        }
        $target_file = $dir . basename($_FILES["dp"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // echo $target_file. " ". $imageFileType; exit;
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "gif" && $imageFileType != "jpeg") {
            $_SESSION['error'] = "[400] File type not allowed!";
            header("location: register.php");
            exit;
        }

        if (!move_uploaded_file($_FILES["dp"]["tmp_name"], $target_file)) {
            $_SESSION['error'] = "[400] File not uploaded!";
            header("location: register.php");
            exit;
        }

        //If any error occurs please move the block i.e. line 34-42 out of the this if statement and comment out the if statement for $_FILES
        //Delete the image=:image if error occurs
        $image =  $_FILES['dp']['name'];
    }
    else{
        $image = "defUser.png";
    }
    $stmt1 = $conn->prepare("UPDATE patient_details SET fname=:fname, phone=:phone, dob=:dob, address=:addr, email=:email, ephone=:ephone, relation=:relation, gender=:gender, dp=:image WHERE id=" . $_SESSION['id']);
    $stmt1->execute([
        'fname' => $fname,
        'phone' => $phone,
        'dob' => $dob,
        'addr' => $address,
        'email' => $email,
        'ephone' => $ephone,
        'relation' => $relation,
        'gender' => $gender,
        'dp' => $image, //Create an image column in the patient_details table || comment out if error occurs
    ]);
    unset($_SESSION['id']);
}

if(isset($_POST, $_POST['redirect'])){
    header("location: register.php");
    exit;
}

$stmt = $conn->prepare("SELECT * from patient_details WHERE fname IS NULL");
$stmt->execute();
$rowCount = $stmt->rowCount();
$emptyData = $stmt->fetch();
?>
<body>
    <div class="container">
        <?php
        displaySidebar($links);
        displayDashboard();
        
        ?>
        <div class="body-section">
            <?php 
            if ($rowCount > 0) {
                $_SESSION['id'] = $emptyData['id'];
                echo "<script>alert('Continue?')</script>";
            ?>
            <div class="register-details">
                <h3>Patient Form</h3>
                <?=flashMessages()?>
                <form method="POST" action="register.php">
                    <input type="text" name="fname" placeholder="Full Name">
                    <input type="text" name="address" placeholder="Address">
                    <input type="number" name="phone" placeholder="Phone Number">
                    <input type="email" name="email" placeholder="Email Address">
                    <div class="two-columns">
                        <input type="number" name="ephone" placeholder="Emergency Contact Number">
                        <select name="relation">
                            <option disabled>--Relation--</option>
                            <option value="parents">Parents</option>
                            <option value="spouse">Spouse</option>
                            <option value="brother">Brother</option>
                            <option value="sister">Sister</option>
                        </select>
                    </div>
                    <div class="two-columns">
                        <select name="gender">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="others">Others</option>
                        </select>
                        
                        DOB: <input type="date" name="date">
                    </div>

                    <input class="image-upload" type="file" name="dp">

                    <button type="submit" class="display-block-center">Create New Patient</button>
                </form>
            </div>
            <?php
        }
        else{
        ?>  
            <div class="fingerprint-registering">
                <h3>Fingerprint registering...</h3>
                <img src="../img/spinner.gif">
                <p>Kindly refresh the page after few minutes!</p>
                <form method="POST" action="register.php">
                    <button class="submit" name="redirect"> 
                        Reload
                    </button>
                </form>
            </div>
        <?php
        }
        ?>
        </div>
    
        <!-- div:dashboard-wrapper closing -->
    </div>
    </div>

</body>

</html>