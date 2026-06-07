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
        include 'check-admin.php';

        include './../koneksi.php';
        /** @var mysqli $koneksi */

        // profile
        $username = htmlspecialchars($_SESSION['ses_username']);
        
        // Load profile image
        $profileImage = '../picture/user-profile.jpg';
        $safeUsername = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $_SESSION['ses_username']);
        $profileDir = __DIR__ . '/../picture/profile/';
        
        // Check for files matching student profile convention (username.ext)
        $studentFormatFiles = glob($profileDir . $safeUsername . '.*');
        if (!empty($studentFormatFiles)) {
            $profileImage = '../picture/profile/' . basename($studentFormatFiles[0]);
        } else {
            // If not found, check for files with timestamp convention (username_*.ext)
            $adminFormatFiles = glob($profileDir . $safeUsername . '_*');
            if (!empty($adminFormatFiles)) {
                $latest = end($adminFormatFiles);
                if (file_exists($latest)) {
                    $profileImage = '../picture/profile/' . basename($latest);
                }
            }
        }
        
        // active person
        $query = mysqli_query($koneksi, "SELECT first_name FROM user WHERE username='$username'");

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
            
        if(isset($_SESSION['ses_tipe']) && $_SESSION['ses_tipe'] == 1){

        // jadwalll-event
        $week = mysqli_query($koneksi, "SELECT COUNT(*) AS cnt FROM agenda WHERE YEARWEEK(tanggal, 1) = YEARWEEK(CURDATE(), 1)");
        $events_week = 0;
        if ($week) {
            $events_week = intval(mysqli_fetch_assoc($week)['cnt']);
        }

        // codeclass

            $admin_login = $_SESSION['ses_username'];
            $query_code = mysqli_query($koneksi, "SELECT class_code FROM user WHERE username='$admin_login'");
            $data_code = mysqli_fetch_assoc($query_code);
            $class_code = isset($data_code['class_code']) ? $data_code['class_code'] : "XI RPL 2";
    
            $daftar_hari = [
                'Monday' => 'senin',
                'Tuesday' => 'selasa',
                'Wednesday' => 'rabu',
                'Thursday' => 'kamis',
                'Friday' => 'jumat'
            ];
            $hari = date('l');
            $kolom_hari = isset($daftar_hari[$hari]) ? $daftar_hari[$hari] : '';
            if (!empty($kolom_hari)) {
                $sql_jadwal = "SELECT COUNT(DISTINCT `$kolom_hari`) AS cnt FROM jadwal_pelajaran WHERE `$kolom_hari` IS NOT NULL AND `$kolom_hari` != ''";
                $result_jadwal = $koneksi->query($sql_jadwal);
                if ($result_jadwal) {
                    $row = $result_jadwal->fetch_assoc();
                    $total_schedule = isset($row['cnt']) ? (int) $row['cnt'] : 0;
                }
            }
        ?>
    

    <!--NAVIGATION BAR START  -->
    <div class="sidebar">
        <div class="logo-branding">
            <img src="../picture/logo.png" alt="" class="logo">
        </div>
        <div class="user-profile">
            <a href="admin.php?page=prfl">
                <img src="<?php echo $profileImage; ?>" alt="" class="img-profile">
                <div class="user-name">
                    <h3><?php echo $username;?></h3>
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
                        <img src="../picture/schedule.png" alt="" class="icon">
                        <span>Schedule</span>
                    </li>
                </a>
                <a href="admin.php?page=evnt">
                    <li>
                        <img src="../picture/event.png" alt="" class="icon">
                        <span>Event</span>
                    </li>
                </a>
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
            <p><?php echo htmlspecialchars($class_code); ?></p>
            <!-- <img src="../picture/dashboard.png" alt="" class="icon"> -->
        </div>
    </div>
    <div class="summary-card">
        <div class="stat-card">
            <img src="../picture/group_8215621.png" alt="" class="icon">
            <h3><?php 
                if ($total_active > 0):
                    echo $total_active;
                else: 
                    echo "0";
                endif;
                ?> siswa aktif</h3>
        </div>
        <div class="stat-card">
            <img src="../picture/event.png" alt="" class="icon">
            <h3><?php echo $events_week; ?> agenda minggu ini</h3>
        </div>
        <div class="stat-card">
            <img src="../picture/appointment (1).png" alt="" class="icon">
            <h3><?php 
                if ($total_schedule > 0):
                    echo $total_schedule;
                else: 
                    echo "0";
                endif;
                ?> jadwal hari ini</h3>
        </div>
        <!-- <div class="stat-card">
            <img src="../picture/notification (1).png" alt="" class="icon">
            <h3><?php 
                if ($total_notifications > 0):
                    echo $total_notifications;
                else: 
                    echo "0";
                endif;
                ?> notifikasi belum dibaca</h3>
        </div> -->
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

    