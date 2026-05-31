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

    // Ambil semua siswa yang belum absen atau belum izin hari ini
    $tanggal_skrg = date('Y-m-d');
    
    // Query: Siswa yang TIDAK ada di attendance hari ini ATAU status bukan Present/Permit/Sick
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
    <div class="present-students" id="absent">
        <div class="chart-desc">
            <div class="chart-name">
                <!-- <h2>Absent</h2> -->
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
                <h2><?php echo $total_absent; ?></h2>
                <p>siswa</p>
            </div>
        </div>
        <div class="chart-students">
            <table>
                <thead>
                    <tr>
                        <th>Students</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($total_absent > 0): ?>
                        <?php foreach ($data_absent as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['username']);?></td>
                            <td><span style="color: red; font-weight: bold;">Belum Scan/Izin</span></td>
                        </tr>
                        <?php endforeach;?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2" style="text-align: center; color: green;">Semua siswa sudah absen atau izin hari ini</td>
                        </tr>
                    <?php endif;?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>