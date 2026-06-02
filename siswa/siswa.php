<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page Admin</title>
    <link rel="stylesheet" href="../css/sis.css">
</head>
<body>
    <?php
        session_start();

        include './../koneksi.php';
        /** @var mysqli $koneksi */

        if(!isset($_SESSION['ses_tipe'])){
            header('location:../login.php?msg=login');
            exit();
        }
        if($_SESSION['ses_tipe'] != 2 && $_SESSION['ses_tipe'] != 1){
            echo "<script>alert('Maaf, akses tidak diizinkan.'); window.history.back();</script>";
            exit();
        }

        // evnt

        $week = mysqli_query($koneksi, "SELECT COUNT(*) AS cnt FROM agenda WHERE YEARWEEK(tanggal, 1) = YEARWEEK(CURDATE(), 1)");
        $events_week = 0;
        if ($week) {
            $events_week = intval(mysqli_fetch_assoc($week)['cnt']);
        }

    ?>

    <!-- HEADER START  -->
    <div class="header">
        <div class="logo-branding">
            <img src="../picture/logo.png" alt="" class="logo">
            <h1>XI RPL 2</h1>
        </div>
        <div class="chart-container">
            <!-- <p>33550</p> -->
            <img src="../picture/logo.png" alt="" class="logo">
        </div>
    </div>
    <!-- HEADER END -->
    
    <!-- APP INFORMATION START -->
    <div class="summary-card">
        <div class="stat-card">
            <img src="../picture/dashboard.png" alt="" class="icon">
            <h3>1 jadwal hari ini</h3>
        </div>
        <div class="stat-card">
            <img src="../picture/dashboard.png" alt="" class="icon">
            <h3><?php echo $events_week; ?> agenda minggu ini</h3>
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
                    case "attd":
                        include "s-attendance.php";
                        break;
                    case "schd":
                        include "s-schedule.php"; 
                        break;
                    case "evnt":
                        include "s-event.php"; 
                        break;   
                    case "prfl":
                        include "s-profile.php";
                        break; 
                }
            }
        ?>
    </div>

    

    <nav class="nav-bottom">
        <ul>
            <a href="siswa.php?page=attd">
                <li>
                    <img src="../picture/attendance.png" alt="" class="icon">
                </li>
            </a>
            <a href="siswa.php?page=schd">
                <li>
                    <img src="../picture/dashboard.png" alt="" class="icon">
                </li>
            </a>
            <a href="siswa.php?page=evnt">
                <li>
                    <img src="../picture/attendance.png" alt="" class="icon">
                </li>
            </a>
            <a href="siswa.php?page=prfl">
                <li>
                    <img src="../picture/dashboard.png" alt="" class="icon">
                </li>
            </a>
        </ul>
    </nav>

</body>
</html>

