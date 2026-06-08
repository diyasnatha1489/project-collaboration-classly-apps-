<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./../css/att-option.css">
</head>
<body>
    <?php
    
    include './../koneksi.php';
    /** @var mysqli $koneksi */

    // Mengambil data absensi hari ini yang berstatus sick
    $query = "SELECT user.username, user.username AS nama_siswa, attendance.date, attendance.time
            FROM attendance
            JOIN user ON attendance.username = user.username
            WHERE attendance.date = CURDATE() AND attendance.status = 'Sick'
            ORDER by attendance.time ASC";

    // Gunakan query langsung dengan mysqli, lalu pastikan $data_sick selalu array
    $result = $koneksi->query($query);
    if ($result) {
        $data_sick = $result->fetch_all(MYSQLI_ASSOC);
        $total_sick = count($data_sick);
    } else {
        $data_sick = [];
        $total_sick = 0;
    }
    
    ?>
    <div class="present-students" id="present">
        <div class="chart-desc">
            <div class="chart-name">
                <!-- <h2>Present</h2> -->
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
            </div>
            <div class="students">
                <h2><?php echo $total_sick; ?></h2>
                <p>siswa</p>
            </div>
        </div>
        <div class="chart-students">
            <table>
                <thead>
                    <tr>
                        <th>Students</th>
                        <th>Date</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($total_sick > 0): ?>
                        <?php foreach ($data_sick as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['nama_siswa']);?></td>
                            <td><?php echo $row['date'];?></td>
                            <td><?php echo date('H:i', strtotime($row['time'])) . 'WIB';?></td>
                        </tr>
                        <?php endforeach;?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" style="text-align: center; color: red;">Belum ada siswa yang absen atau izin hari ini</td>
                        </tr>
                    <?php endif;?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>