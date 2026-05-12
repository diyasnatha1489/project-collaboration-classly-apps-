<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page Admin</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <?php
        session_start();

        if(isset($_SESSION['ses_tipe'])==1){
    ?>

    <!--NAVIGATION BAR START  -->
    <div class="sidebar">
        <div class="logo-branding">
            <img src="../picture/logo.png" alt="" class="logo">
        </div>
        <div class="user-profile">
            <a href="admin.php?page=prfl">
                <img src="../picture/user-profile.jpg" alt="" class="img-profile">
                <div class="user-name">
                    <h3>Maula Qodri Lail</h3>
                    <p>Admin</p>
                </div>                        
            </a>
        </div>
        <nav class="navigation-menu">
            <ul>
                <a href="admin.php?page=dash">
                    <li>
                        <img src="../picture/dashboard.png" alt="" class="icon">
                        <span>Dashboard</span>
                    </li>
                </a>
                <a href="admin.php?page=attd">
                    <li>
                        <img src="../picture/attendance.png" alt="" class="icon">
                        <span>Attendance</span>
                    </li>
                </a>
                <a href="admin.php?page=schd">
                    <li>
                        <img src="../picture/dashboard.png" alt="" class="icon">
                        <span>Schedule</span>
                    </li>
                </a>
                <a href="admin.php?page=evnt">
                    <li>
                        <img src="../picture/attendance.png" alt="" class="icon">
                        <span>Event</span>
                    </li>
                </a>
                <!-- <a href="admin.php?page=insg">
                    <li>
                        <img src="../picture/dashboard.png" alt="" class="icon">
                        <span>Insight</span>
                    </li>
                </a> -->
            </ul>
        </nav>
    </div>
    <!-- NAVIGATION BAR END -->
    
    <!-- APP INFORMATION START -->
    <div class="chart-container">
        <div class="class-name">
            <h1>XI RPL 2</h1>
        </div>
        <div class="fast-statistic">
            <p>33550</p>
            <img src="../picture/dashboard.png" alt="" class="icon">
        </div>
    </div>
    <div class="summary-card">
        <div class="stat-card">
            <img src="../picture/dashboard.png" alt="" class="icon">
            <h3>24 siswa aktif</h3>
        </div>
        <div class="stat-card">
            <img src="../picture/dashboard.png" alt="" class="icon">
            <h3>3 Agenda minggu ini</h3>
        </div>
        <div class="stat-card">
            <img src="../picture/dashboard.png" alt="" class="icon">
            <h3>1 jadwal hari ini</h3>
        </div>
        <div class="stat-card">
            <img src="../picture/dashboard.png" alt="" class="icon">
            <h3>2 notifikasi belum dibaca</h3>
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

    