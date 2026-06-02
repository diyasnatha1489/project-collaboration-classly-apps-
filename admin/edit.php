<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule</title>
    <link rel="stylesheet" href="../css/edit.css">
</head>
<body>
    <?php
    include '../koneksi.php';
    /**  @var mysqli $koneksi */    
    $id = $_GET['id'] ?? '';
    if (!ctype_digit($id)) {
        echo "ID tidak valid. Silakan kembali dan coba lagi.";
        exit();
    }
    $query = "SELECT * FROM jadwal_pelajaran WHERE id=$id";
    $result = mysqli_query($koneksi, $query);
    if (!$result) {
        die('Database query error: ' . mysqli_error($koneksi));
    }
    $edit = mysqli_fetch_assoc($result);
    if (!$edit) {
        echo "Data tidak ditemukan. Silakan kembali dan coba lagi.";
        exit();
    }
    
    ?>
   <?php
if (isset($_POST['update'])) {
    $id = $_POST['id'] ?? '';
    $waktu = mysqli_real_escape_string($koneksi, $_POST['waktu'] ?? '');
    $senin = mysqli_real_escape_string($koneksi, $_POST['senin'] ?? '');
    $selasa = mysqli_real_escape_string($koneksi, $_POST['selasa'] ?? '');
    $rabu = mysqli_real_escape_string($koneksi, $_POST['rabu'] ?? '');
    $kamis = mysqli_real_escape_string($koneksi, $_POST['kamis'] ?? '');
    $jumat = mysqli_real_escape_string($koneksi, $_POST['jumat'] ?? '');

    if (!ctype_digit($id)) {
        echo "ID tidak valid. Silakan kembali dan coba lagi.";
    } else {
        $query = "UPDATE jadwal_pelajaran SET waktu='$waktu', senin='$senin', selasa='$selasa', rabu='$rabu', kamis='$kamis', jumat='$jumat' WHERE id=$id"; 
        if (mysqli_query($koneksi, $query)) {
            header("Location: admin.php?page=schd");
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($koneksi);
        }
    }
}
?> 
<div class="edit_form">
    <h2>Edit Jadwal</h2>
        <form method="POST">
        <input type="hidden"
        name="id"
        value="<?= $edit['id'] ?? ''; ?>">
        <label>Waktu</label><br>
        <input type="text"
        name="waktu"
        value="<?= $edit['waktu'] ?? ''; ?>"><br>
        <label>Senin</label><br>
        <input type="text"
        name="senin"
        value="<?= $edit['senin'] ?? ''; ?>"><br>
        <label>Selasa</label><br>
        <input type="text"
        name="selasa"
        value="<?= $edit['selasa'] ?? ''; ?>"><br>
        <label>Rabu</label><br>
        <input type="text"
        name="rabu"
        value="<?= $edit['rabu'] ?? ''; ?>"><br>
        <label>Kamis</label><br>
        <input type="text"
        name="kamis"
        value="<?= $edit['kamis'] ?? ''; ?>"><br>
        <label>Jumat</label><br>
        <input type="text"
        name="jumat"
        value="<?= $edit['jumat'] ?? ''; ?>"><br><br>
        <div class="button-group">
            <a href="admin.php?page=schd" class="edit-btn"><-</a>
            <button type="submit" name="update">
                Simpan Perubahan
            </button>
        </div>
        </form>
</div>
</body>
</html>
