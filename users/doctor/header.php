<?php
require "../layouts/sidebar.php" ;
require "../layouts/dashboard.php" ;

$links = [
    [
        'title' => 'dashboard',
        'link' => 'index.php',
    ],
    
    [
        'title' => 'scan patient',
        'link' => 'scan-patient.php',
    ],

];
?>
<link rel="stylesheet" type="text/css" href="../../css/dashboard.css">
<link rel="stylesheet" type="text/css" href="../../css/sidebar.css">
<link rel="stylesheet" type="text/css" href="../../css/style.css">
<title>Admin Panel</title>