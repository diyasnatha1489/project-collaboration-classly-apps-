<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Page</title>
    <link rel="stylesheet" href="../css/dashb.css">
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
    

    // SCHEDULE
    // mapping nama hari (Inggris) ke nama kolom di database
    $daftar_hari = [
        'Monday' => 'senin',
        'Tuesday' => 'selasa',
        'Wednesday' => 'rabu',
        'Thursday' => 'kamis',
        'Friday' => 'jumat'
    ];
    $hari = date('l'); 
    $kolom_hari = isset($daftar_hari[$hari]) ? $daftar_hari[$hari] : '';
    //array jadwal
    $list_jadwal = [];

    if (!empty($kolom_hari)) {
        $sql_jadwal = "SELECT `$kolom_hari` AS mapel, waktu 
        FROM jadwal_pelajaran 
        WHERE `$kolom_hari` IS NOT NULL 
        AND `$kolom_hari` != '' 
        ORDER BY id ASC";

        $result_jadwal = mysqli_query($koneksi, $sql_jadwal);
        if ($result_jadwal && mysqli_num_rows($result_jadwal) > 0) {
            while ($row = mysqli_fetch_assoc($result_jadwal)) {
                $mapel = $row['mapel'];
                $jam = $row['waktu'];
                //jika mapel belum ada
                if (!isset($list_jadwal[$mapel])) {
                    $list_jadwal[$mapel] =[];
                }
                //masukkan jam ke dalam mapel
                $list_jadwal[$mapel][] = $jam;
        }
    }
    }
   
    
    // eventtt

    $sql_evnt = "SELECT COUNT(*) AS total_event FROM agenda WHERE tanggal = CURDATE()";
    $result_evnt = mysqli_query($koneksi, $sql_evnt);
    $data_evnt = mysqli_fetch_assoc($result_evnt);
    $total_event = $data_evnt['total_event'];
    $text_event = "0 Event";

    if ($total_event > 0) {
        $text_event = "$total_event Event";
        $class_event = "red flex";
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
                <a href="admin.php?page=attd">Detail</a>
            </div>
        </div>
        <div class="quick-stats">
            <h3>Event</h3>
            <p>Hari ini</p>
            <h2 class="red flex">Tidak Ada Event</h2>
            <h2 class="<?php echo $class_event; ?>"><?php echo $text_event;  ?></h2>
            <div class="show-detail">
                <a href="admin.php?page=evnt">Detail</a>
            </div>
        </div>
        <div class="quick-stats">
            <h3>Jadwal Pelajaran</h3>
            <p>Hari ini <?php echo ucfirst($kolom_hari); ?></p>
            <div class="jadwal-list">
                <?php if (!empty($list_jadwal)): ?>
                    <?php foreach ($list_jadwal as $mapel => $jam): ?>
                       <?php 
                       $jam_awal =  preg_replace('/[^0-9]/', '', reset($jam));
                       $jam_akhir = preg_replace('/[^0-9]/', '', end($jam));
                       ?>
                    <div class="jadwal-item">
                        <div class="mapel">
                            <h2><?php echo htmlspecialchars(strtoupper($mapel));?></h2>
                        </div>
                        <div class="jam">    
                            <?php 
                            if ($jam_awal == $jam_akhir){
                                echo "Jam ".$jam_awal;
                            } else {
                                echo "Jam ".$jam_awal." - ".$jam_akhir;
                            }
                            ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div>
                        <h2 class="red">Tidak Ada Jadwal</h2>
                        <p>Bukan jam sekolah</p>
                    </div>
                <?php endif; ?>
            </div>
        <div class="show-detail">
            <a href="admin.php?page=schd">Detail</a>
        </div>
    </div>
</body>
</html>