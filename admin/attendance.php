<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Page</title>
    <link rel="stylesheet" href="../css/attendance.css">
</head>
<body>
    <nav class="attendance-nav">
        <ul>
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
        </ul>

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
                default:
                    echo "<p>Halaman kehadiran belum tersedia atau tidak ditemukan.</p>";
                    break;
            }
            ?>
        </div>

        <div class="attendance-barcode">
            <img src="../picture/barcode.png" alt="Barcode">
        </div>
    </nav>

    
</body>
</html>