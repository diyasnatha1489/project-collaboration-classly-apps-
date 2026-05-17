<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Page</title>
    <link rel="stylesheet" href="../css/attd.css">
</head>
<body>
    <div class="container-att">
    <nav class="attendance-nav">
        <!-- <ul>
            <a href="admin.php?page=attd&attendance=present">
                <li>Present</li>
            </a>
            <a href="admin.php?page=attd&attendance=permit">
                <li>Permit</li>
            </a>
            <a href="admin.php?page=attd&attendance=sick">
                <li>Sick</li>
            </a>
            <a href="admin.php?page=attd&attendance=absent">
                <li>Absent</li>
            </a>
        </ul> -->

        <div class="attendance-container">
            <?php
            $attendancePage = isset($_GET["attendance"]) ? $_GET["attendance"] : "present";
            switch($attendancePage){ 
                case "present":
                    include "attendance/present.php";
                    break;
                case "permit":
                    include "attendance/permit.php";
                    break;
                case "sick":
                    include "attendance/sick.php";
                    break;
                case "absent":
                    include "attendance/absent.php";
                    break;
                default:
                    echo "<p>Halaman kehadiran belum tersedia atau tidak ditemukan.</p>";
                    break;
            }
            ?>
        </div>
    </nav>
    <!-- <nav class="attendance-nav"> -->
        <div class="attendance-barcode">
            <h2>Scan QR Code</h2>
            <p>Scan QR code untuk melakukan absensi</p>
            <div class="barcode-placeholder">
                <!-- Placeholder untuk barcode -->
                <?php
                    $tanggal = date("Y-m-d");
                    $secret_code = "Classly-Barcode".$tanggal;

                    $google_chart_url = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=" . $secret_code;
                ?>
                <img src="<?php echo $google_chart_url; ?>" alt="QR Code">
            </div>
        </div>
    <!-- </nav> -->
    </div>
    
</body>
</html>