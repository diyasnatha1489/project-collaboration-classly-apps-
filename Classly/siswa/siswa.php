<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <ul>
        <li><a href="manager.php?page=attd">Attendance Page</a></li>
        <li><a href="manager.php?page=schd">Schedule Page</a></li>
    </ul>
</body>
</html>

<?php
if(isset($_GET["page"])){
    $page = $_GET["page"];
    switch($page){
        case "attd":
            include "attendance.php";
            break;
        case "schd":
            include "schedule.php"; 
            break;   
    }
}
?>


<?php
    session_start();

    if(isset($_SESSION['ses_tipe'])==2){
?>

        Ini halaman manager. <a href="logout.php">Log Out</a>

<?php

    } else {
        echo "Anda belum login, silahkan login terlebih dahulu";
    }
?>