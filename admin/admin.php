<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page Admin</title>
    <link rel="stylesheet" href="../css/admin.css">
    <?php if(isset($_GET['page']) && $_GET['page'] == 'evnt'){ ?>
        <link rel="stylesheet" href="../css/event.css">
    <?php } ?>
</head>
<body>
    <?php
        session_start();
        include './../koneksi.php';
        /** @var mysqli $koneksi */

        $query = "SELECT username FROM user WHERE tipe = 2";

        $result = $koneksi->query($query);
        if ($result) {
            $data_active = $result->fetch_all(MYSQLI_ASSOC);
            $total_active = count($data_active);
        } else {
            $data_active = [];
            $total_active = 0;
        }

        $total_schedule = 0;
        $total_events = 0;
        $total_notifications = 0;
            
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
            <h3><?php 
                if ($total_active > 0):
                    echo $total_active;
                else: 
                    echo "0";
                endif;
                ?> siswa aktif</h3>
        </div>
        <div class="stat-card">
            <img src="../picture/dashboard.png" alt="" class="icon">
            <h3><?php 
                if ($total_schedule > 0):
                    echo $total_schedule;
                else: 
                    echo "0";
                endif;
                ?> jadwal hari ini</h3>
        </div>
        <div class="stat-card">
            <img src="../picture/dashboard.png" alt="" class="icon">
            <h3><?php 
                if ($total_events > 0):
                    echo $total_events;
                else: 
                    echo "0";
                endif;
                ?> agenda minggu ini</h3>
        </div>
        <div class="stat-card">
            <img src="../picture/dashboard.png" alt="" class="icon">
            <h3><?php 
                if ($total_notifications > 0):
                    echo $total_notifications;
                else: 
                    echo "0";
                endif;
                ?> notifikasi belum dibaca</h3>
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
                case "edit":
                    include "edit.php"; 
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

    