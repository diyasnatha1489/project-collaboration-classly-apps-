<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page Admin</title>
    <link rel="stylesheet" href="p.css">
</head>
<body>
    <?php
        session_start();

        if(isset($_SESSION['ses_tipe'])==1){
    ?>

    <!--NAVIGATION BAR START  -->
    <header>
        <nav>
            <img src="picture/logo.png" alt="" class="logo">
            <ul>
                <li>
                    <img src="picture/user-profile.jpg" alt="" class="img-profile">
                    <a href="admin.php?page=prfl">Profile</a>
                </li>
            
                <p>MENU UTAMA</p>
            
                <li>
                    <img src="picture/dashboard.png" alt="" class="icon">
                    <a href="admin.php?page=dash">Dashboard</a>
                </li>
                <li>
                    <img src="picture/attendance.png" alt="" class="icon">
                    <a href="admin.php?page=attd">Attendance</a>
                </li>
                <li>
                    <img src="picture/dashboard.png" alt="" class="icon">
                    <a href="admin.php?page=schd">Schedule</a>
                </li>
                <li>
                    <img src="picture/attendance.png" alt="" class="icon">
                    <a href="admin.php?page=evnt">Event</a>
                </li>
                <li>
                    <img src="picture/dashboard.png" alt="" class="icon">
                    <a href="admin.php?page=insg">Insight</a>
                </li>
            </ul>
        </nav>
    </header>
    <!-- NAVIGATION BAR END -->
    
    <!-- APP INFORMATION START -->
    <div class="appInformation">
        <div class="className">
            <h1>XI RPL 2</h1>
        </div>
        <div class="classCode">
            <p>33550</p>
            <img src="picture/dashboard.png" alt="" class="icon">
        </div>
    </div>
    <div class="flashcard">
        <div class="f-card">
            <img src="picture/dashboard.png" alt="" class="icon">
            <p>24 siswa aktif</p>
        </div>
        <div class="f-card">
            <img src="picture/dashboard.png" alt="" class="icon">
            <p>3 Agenda minggu ini</p>
        </div>
        <div class="f-card">
            <img src="picture/dashboard.png" alt="" class="icon">
            <p>1 jadwal hari ini</p>
        </div>
        <div class="f-card">
            <img src="picture/dashboard.png" alt="" class="icon">
            <p>2 notifikasi belum dibaca</p>
        </div>
    </div>
    <!-- APP INFORMATION END -->

    
    <div class="container">
        <?php
        if(isset($_GET["page"])){
            $page = $_GET["page"];
            switch($page){
                case "dash":
                    include "dashboard.php";
                    break;
                case "attd":
                    include "attendance.php";
                    break;
                case "schd":
                    include "schedule.php"; 
                    break;  
                case "prfl":
                    include "profile.php";
                    break;
                case "evnt":
                    include "event.php"; 
                    break;  
            }
        }
        ?>
    </div>

    <?php

        } else {
            echo "Anda belum login, silahkan login terlebih dahulu";
        }
    ?>    
</body>
</html>

    