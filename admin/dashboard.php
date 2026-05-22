<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Page</title>
    <link rel="stylesheet" href="../css/dash.css">
</head>
<body>
    <?php
    
    include './../koneksi.php';
    /** @var mysqli $koneksi */

    // Mengambil data absensi hari ini yang berstatus present
    $query = "SELECT user.username, user.username AS nama_siswa, attendance.date, attendance.time
            FROM attendance
            JOIN user ON attendance.username = user.username
            WHERE attendance.date = CURDATE() AND attendance.status = 'Present'
            ORDER by attendance.time ASC";

    // Gunakan query langsung dengan mysqli, lalu pastikan $data_present selalu array
    $result = $koneksi->query($query);
    if ($result) {
        $data_present = $result->fetch_all(MYSQLI_ASSOC);
        $total_present = count($data_present);
    } else {
        $data_present = [];
        $total_present = 0;
    }

    $tanggal_skrg = date('Y-m-d');

    $query = "SELECT user.username FROM user WHERE tipe = 2 AND username NOT IN (
                  SELECT username FROM attendance 
                  WHERE date = '$tanggal_skrg' AND status IN ('Present', 'Permit', 'Sick')
              )
              ORDER BY user.username ASC";

    $result = $koneksi->query($query);
    if ($result) {
        $data_absent = $result->fetch_all(MYSQLI_ASSOC);
        $total_absent = count($data_absent);
    } else {
        $data_absent = [];
        $total_absent = 0;
    }
    
    
    ?>
    <div class="summary-quick">
        <div class="quick-stats">
            <h3>Absensi</h3>
            <p>Hari ini</p>
            <div class="flex">
                <div>
                    <h2><?php echo $total_present; ?></h2>
                    <p>Hadir</p>
                </div>
                <div>
                    <h2 class="red"><?php echo $total_absent; ?></h2>
                    <p>Tidak Hadir</p>
                </div>
            </div>
            <div class="show-detail">
                <p>Detail</p>
            </div>
        </div>
        <div class="quick-stats">
            <h3>Event</h3>
            <p>Hari ini</p>
            <h2 class="red flex">Tidak Ada Event</h2>
            <div class="show-detail">
                <p>Detail</p>
            </div>
        </div>
        <div class="quick-stats">
            <h3>Jadwal Pelajaran</h3>
            <p>Hari ini</p>
            <div class="flex">
                <div>
                    <h2>PK</h2>
                    <p>Jam ke 1-5</p>
                </div>
                <div>
                    <h2>MTK</h2>
                    <p>Jam ke 6-8</p>
                </div>
                <div>
                    <h2>PP</h2>
                    <p>Jam ke 9-10</p>
                </div>
            </div>
            <div class="show-detail">
                <p>Detail</p>
            </div>
        </div>
    </div>
    <!-- <div class="summary-quick">
        <div class="quick-stats">
            <h3>Absensi</h3>
            <p>Hari ini</p>
        </div>
    </div> -->
</body>
</html>