<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule</title>
    <link rel="stylesheet" href="../css/scedule.css">
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
    <form action="admin.php?page=schd">
    <div class="header">
        <a href="admin.php?page=schd" class="edit-btn"><-</a>
        <button type="submit" name="save" class="edit-btn">save</button>
    </div>
    <div class="table_container">
        <table>
            <tr>
                <th>Waktu</th>
                <th>Senin</th>
                <th>Selasa</th>
                <th>Rabu</th>
                <th>Kamis</th>
                <th>Jumat</th>
                <th>Aksi</th>
            </tr>
    <?php while($data = mysqli_fetch_array($result)) { ?>
        <tr>
            <td><?= $data['waktu']; ?></td>
            <td><?= $data['senin']; ?></td>
            <td><?= $data['selasa']; ?></td>
            <td><?= $data['rabu']; ?></td>
            <td><?= $data['kamis']; ?></td>
            <td><?= $data['jumat']; ?></td>

            <td>
                <a href="edit.php?id=<?= $data['id']; ?>">
                    Edit
                </a>
            </td>
        </tr>
    <?php } ?>
        </table>
    </div>
    </form>
</body>
</html>