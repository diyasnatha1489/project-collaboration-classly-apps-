<?php
$included_in_admin = basename($_SERVER['PHP_SELF']) === 'admin.php';
$base_url = $included_in_admin ? 'admin.php?page=evnt' : 'event.php';
?>

<?php if (!$included_in_admin) { ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Page</title>
    <link rel="stylesheet" href="../css/event.css">
</head>
<body>
<?php } ?>

<section class="event-section">
        
        <a href="<?= $base_url ?>&action=tambah" class="btn-new-event">
            <span>Agenda Baru</span>
            <span>+</span>
        </a>

        <h3 class="bulan">NOVEMBER</h3>

        <?php 
        include "../koneksi.php";
        $query = mysqli_query($koneksi, "SELECT * FROM agenda ORDER BY tanggal ASC");
        
        while($data = mysqli_fetch_array($query)){


        ?>
            <div class="card-event">
                <div class="info">
                    <strong><?= $data['tanggal'] ?></strong>
                    <p><?= $data['judul'] ?></p>
                </div>
                <div class="aksi">
                    <a href="<?= $base_url ?>&action=edit&id=<?= $data['id'] ?>">✏️</a>
                    <a href="<?= $base_url ?>&action=hapus&id=<?= $data['id'] ?>" onclick="return confirm('Hapus agenda?')">🗑️</a>
                </div>
            </div>
        <?php } ?>
    </section>

    <?php if(isset($_GET['action']) && $_GET['action'] == 'tambah'){ ?>
    <div class="overlay">
        <div class="modal">
            <header>
                <a href="<?= $base_url ?>"> < Agenda Baru</a>
            </header>
            <form action="" method="POST">
                <input type="date" name="ftanggal" required>
                <textarea name="fjudul" placeholder="Deskripsi event..." required></textarea>
                <input type="submit" name="bsimpan" value="Simpan">
            </form>
        </div>
    </div>
    <?php } ?>

    <?php 
    if(isset($_GET['action']) && $_GET['action'] == 'edit'){ 
        $id = $_GET['id'];
        $edit = mysqli_query($koneksi, "SELECT * FROM agenda WHERE id='$id'");
        $d = mysqli_fetch_array($edit);
    ?>
    <div class="overlay">
        <div class="modal">
            <header>
                <a href="<?= $base_url ?>"> < Edit Event</a>
            </header>
            <form action="" method="POST">
                <input type="hidden" name="fid" value="<?= $d['id'] ?>">
                <input type="date" name="ftanggal" value="<?= $d['tanggal'] ?>">
                <textarea name="fjudul"><?= $d['judul'] ?></textarea>
                <input type="submit" name="bedit" value="Update">
            </form>
        </div>
    </div>
    <?php } ?>

    <?php
    // nyimpen
    if(isset($_POST['bsimpan'])){
        $tgl = $_POST['ftanggal'];
        $jdl = $_POST['fjudul'];
        mysqli_query($koneksi, "INSERT INTO agenda (tanggal, judul) VALUES ('$tgl', '$jdl')");
        echo "<script>window.location='{$base_url}';</script>";
    }

    // update
    if(isset($_POST['bedit'])){
        $id = $_POST['fid'];
        $tgl = $_POST['ftanggal'];
        $jdl = $_POST['fjudul'];
        mysqli_query($koneksi, "UPDATE agenda SET tanggal='$tgl', judul='$jdl' WHERE id='$id'");
        echo "<script>window.location='{$base_url}';</script>";
    }

    // hapus
    if(isset($_GET['action']) && $_GET['action'] == 'hapus'){
        $id = $_GET['id'];
        mysqli_query($koneksi, "DELETE FROM agenda WHERE id='$id'");
        echo "<script>window.location='{$base_url}';</script>";
    }
    ?>

<?php if (!$included_in_admin) { ?>
</body>
</html>
<?php } ?>