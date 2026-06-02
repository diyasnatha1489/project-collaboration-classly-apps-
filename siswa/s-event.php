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
        <h3>NOVEMBER</h3>

        <?php 
        include "../koneksi.php";
        /** @var mysqli $koneksi */

        $query = mysqli_query($koneksi, "SELECT * FROM agenda ORDER BY tanggal ASC");
        
        while($data = mysqli_fetch_array($query)){


        ?>
            <div class="card-event">
                <div class="info">
                    <strong><?= $data['tanggal'] ?></strong>
                    <p><?= $data['judul'] ?></p>
                </div>
            </div>
        <?php } ?>
    </section>


    <?php 
    if(isset($_GET['action']) && $_GET['action'] == 'edit'){ 
        $id = $_GET['id'];
        $edit = mysqli_query($koneksi, "SELECT * FROM agenda WHERE id='$id'");
        $d = mysqli_fetch_array($edit);
    ?>
    <?php } ?>

<?php if (!$included_in_admin) { ?>
</body>
</html>
<?php } ?>