<?php
require "../layouts/sidebar.php" ;
require "../layouts/dashboard.php" ;
require "../pdo.php";
require "../utils.php";

$links = [
    [
        'title' => 'dashboard',
        'link' => 'index.php',
    ],
    
    [
        'title' => 'users',
        'link' => 'users.php',
    ],

    [
        'title' => 'logs',
        'link' => 'logs.php',
    ],

];
?>
<link rel="stylesheet" type="text/css" href="../../css/dashboard.css">
<link rel="stylesheet" type="text/css" href="../../css/sidebar.css">
<link rel="stylesheet" type="text/css" href="../../css/style.css">
<title>Admin Panel</title>