<?php
require './pdo.php';
require "./utils.php";

//insert admin in Database
/* $stmt = $conn->prepare("INSERT INTO users(email, name, password, role) VALUES(:email, :name, :password, :role)");

try {
    $stmt->execute(array(
        "email" => "admin@example.com",
        "password" => password_hash("admin123", PASSWORD_DEFAULT),
        "name" => "Admin",
        "role" => "ADMIN"
    ));
} catch (Exception $th) {
    echo $th;
    echo $conn->errorInfo();
} */

/* $stmt = $conn->prepare("INSERT INTO users(email, name, password, role) VALUES(:email, :name, :password, :role)");

try {
    $stmt->execute(array(
        "email" => "first@responder.com",
        "password" => password_hash("first123", PASSWORD_DEFAULT),
        "name" => "First Responder",
        "role" => "FRESPONDER"
    ));
} catch (Exception $th) {
    echo $th;
    echo $conn->errorInfo();
} */

// $stmt = $conn->prepare("INSERT INTO users(email, name, password, role) VALUES(:email, :name, :password, :role)");

// try {
//     $stmt->execute(array(
//         "email" => "receptionist@login.com",
//         "password" => password_hash("recep123", PASSWORD_DEFAULT),
//         "name" => "Receptionist",
//         "role" => "RECEPTIONIST"
//     ));
// } catch (Exception $th) {
//     echo $th;
//     echo $conn->errorInfo();
// }

/* $stmt = $conn->prepare("INSERT INTO patient_injuries_desc(description, status) VALUES(:desc, :status)");

 try {
    $stmt->execute(array(
        "desc" => "First Patient",
        "status" => "First Patient"
    ));
} catch (Exception $th) {
    echo $th;
    echo $conn->errorInfo();
} */
?>

<title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <form>
        <input type="password" name="pw" id="pw">
        <i class="fa-solid fa-eye" id="toggle"></i>
    </form>
</body>

<script>
    const pwBtn = document.querySelector('#pw')
    document.querySelector('#toggle').addEventListener('click', (event) => {
        pwBtn.type === "password" ? pwBtn.type = "text" : pwBtn.type = "password"
        console.log("clicked");
    })
</script>

</html>
