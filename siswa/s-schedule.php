<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule</title>
    <link rel="stylesheet" href="../css/s-schedule.css">
</head>
<body>
    <?php
    include '../koneksi.php';
    /**  @var mysqli $koneksi */

    $query = "SELECT * FROM jadwal_pelajaran";
    $result = mysqli_query($koneksi, $query);
    if (!$result) {
        die('Database query error: ' . mysqli_error($koneksi));
    }
    ?>
    <div class="title">
        <h2>JADWAL PELAJARAN</h2>
    </div>
    <div class="table_container">
        <table>
            <tr class="table_header">
                <th class="stiky" >Waktu</th>
                <th>Senin</th>
                <th>Selasa</th>
                <th>Rabu</th>
                <th>Kamis</th>
                <th>Jumat</th>
            </tr>
        <?php while($data = mysqli_fetch_array($result)) { ?>
            <tr>
                <td class="stiky" ><?= $data['waktu']; ?></td>
                <td><?= $data['senin']; ?></td>
                <td><?= $data['selasa']; ?></td>
                <td><?= $data['rabu']; ?></td>
                <td><?= $data['kamis']; ?></td>
                <td><?= $data['jumat']; ?></td>
            </tr>
        <?php } ?>
        </table>
    </div>
    
</body>
</html>