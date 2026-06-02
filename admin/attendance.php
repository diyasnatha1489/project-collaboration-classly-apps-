<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Page</title>
    <link rel="stylesheet" href="../css/attd.css">
</head>
<body>
    <?php
        include 'check-admin.php';
    ?>
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
        <div class="attendance-barcode">
            <h2>Scan QR Code</h2>
            <p>Scan QR code untuk melakukan absensi</p>
            <div class="barcode-placeholder">
                <!-- Placeholder untuk barcode -->
                <?php
                    include '../koneksi.php'; 
                    /** @var mysqli $koneksi */

                    $tanggal = date("Y-m-d");
                    $secret_code = "Classly-Barcode" . $tanggal;

                    // Insert QR code ke database
                    $check_query = "SELECT id FROM active_qr WHERE qr_code = '$secret_code'";
                    $check_result = $koneksi->query($check_query);
                    
                    if (!$check_result || $check_result->num_rows == 0) {
                        $insert_query = "INSERT INTO active_qr (qr_code) VALUES ('$secret_code')";
                        $koneksi->query($insert_query);
                    }

                    $google_chart_url = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=" . urlencode($secret_code);
                ?>
                <img src="<?php echo $google_chart_url; ?>" alt="QR Code">
                <p style="font-size: 12px; color: #666; margin-top: 10px;">
                    QR Code: <code><?php echo htmlspecialchars($secret_code); ?></code>
                </p>
            </div>
        </div>
    </div>
    
</body>
</html>