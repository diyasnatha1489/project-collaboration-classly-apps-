<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page Siswa</title>
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

        if(isset($_SESSION['ses_tipe'])==1){
    
        // schedule: count today’s schedule directly from database
        $daftar_hari = [
            'Monday' => 'senin',
            'Tuesday' => 'selasa',
            'Wednesday' => 'rabu',
            'Thursday' => 'kamis',
            'Friday' => 'jumat'
        ]; }
        $hari = date('l');
        $kolom_hari = isset($daftar_hari[$hari]) ? $daftar_hari[$hari] : '';
        $total_schedule = 0;
        if (!empty($kolom_hari)) {
            include './../koneksi.php';
            /** @var mysqli $koneksi */
            $sql_jadwal = "SELECT COUNT(DISTINCT `$kolom_hari`) AS cnt FROM jadwal_pelajaran WHERE `$kolom_hari` IS NOT NULL AND `$kolom_hari` != ''";
            $result_jadwal = $koneksi->query($sql_jadwal);
            if ($result_jadwal) {
                $row = $result_jadwal->fetch_assoc();
                $total_schedule = isset($row['cnt']) ? (int) $row['cnt'] : 0;
            }
        } 

        $status_db = isset($row['status']) ? $row['status'] : '';
        $status_text = 'Belum Absen';

        switch ($status_db) {
            case 'Present':
                $status_text = 'Hadir';
                break;
            case 'Permit':
                $status_text = 'Hadir';
                break;
            case 'Sick':
                $status_text = 'Hadir';
                break;
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
            <!-- <img src="../picture/logo.png" alt="" class="logo"> -->
        </div>
    </div>
    <!-- HEADER END -->
    
    <!-- APP INFORMATION START -->
    <div class="summary-card">
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
            <img src="../picture/checklist.png" alt="" class="icon">
            <h3><?php echo $events_week; ?> agenda minggu ini</h3>
        </div>
        <div class="stat-card">
            <img src="../picture/notification (1).png" alt="" class="icon">
            <h3><?php echo $status_text; ?></h3>
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
                    <img src="../picture/schedule.png" alt="" class="icon">
                </li>
            </a>
            <a href="siswa.php?page=evnt">
                <li>
                    <img src="../picture/event.png" alt="" class="icon">
                </li>
            </a>
            <a href="siswa.php?page=prfl">
                <li>
                    <img src="../picture/user.png" alt="" class="icon">
                </li>
            </a>
        </ul>
    </nav>

</body>
</html>

