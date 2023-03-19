<?php 
    session_start();

    require "./pdo.php";
    require "./utils.php";
    echo $_SESSION['fid'];
    debug($_POST);

    /* if(!isset($_POST)){
        header("location: register.php");
        exit;
    }

    $_SESSION['status'] = 0;
    $_SESSION['register'] = [];
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $fname = validate($_POST['fname']);
        $lname = validate($_POST['lname']);
        $age = validate($_POST['age']);
        $addr = validate($_POST['address']);
        $email = validate($_POST['email']);
        $pass = validate($_POST['password']);
        array_push($_SESSION['register'], $fname);
        array_push($_SESSION['register'], $lname);
        array_push($_SESSION['register'], $age);
        array_push($_SESSION['register'], $addr);
        array_push($_SESSION['register'], $email);
        array_push($_SESSION['register'], $pass);
    }
    
    if(isset($_SESSION['register']) && !empty($_SESSION['register'])){
       echo $_SESSION['status'];
       @$fid = $_GET['fid'];

       try{
        $stmt=$conn->prepare("INSERT into patient_details(fname, lname, age, address, email, fingerprint_id) VALUES(:fname, :lname, :age, :addr, :email, :fid)");
        $stmt->execute([
            "fname"=>$_SESSION['register'][0], 
            "lname"=>$_SESSION['register'][1], 
            "age"=>$_SESSION['register'][2],
            "addr"=>$_SESSION['register'][3],
            "email"=>$_SESSION['register'][4],
            "fid"=>$fid
        ]);
    }catch(Exception $e){

    }
        $stmt=$conn->prepare("INSERT into patient_details(fingerprint_id) VALUES(:fid)");
        $stmt->execute([":fid"=>$fid]);
    }
    else{
        $_SESSION['error'] = "Please fill in the details!";
        header('location: register.php');
        exit;
    } */


?>