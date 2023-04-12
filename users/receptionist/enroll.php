<?php 
    require "./pdo.php";
    require "./utils.php";

    if(isset($_POST, $_POST['enroll'])){
        $stmt = $conn->prepare("UPDATE status SET status =:status");
        $stmt->execute([
            "status" => 1,
        ]);
    
        header("location: register.php");
        exit;
    }
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

</head>

<body>
    <div class="text-center text-lg-start mt-4 pt-2">
        <form action="enroll.php" method="POST">
            <button type="submit" name="enroll" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Enroll Fingerprint</button>
        </form>
    </div>
</body>

</html>