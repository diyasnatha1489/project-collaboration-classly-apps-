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
    <link rel="stylesheet" href="../css/event2.css">
</head>
<body>
<?php } ?>

<section class="event-section">
        <?php
        $selected_month = isset($_GET['month']) ? (int)$_GET['month'] : (int)date('m');
        $months = [
            1 => 'JANUARI', 2 => 'FEBRUARI', 3 => 'MARET', 4 => 'APRIL',
            5 => 'MEI', 6 => 'JUNI', 7 => 'JULI', 8 => 'AGUSTUS',
            9 => 'SEPTEMBER', 10 => 'OKTOBER', 11 => 'NOVEMBER', 12 => 'DESEMBER'
        ];
        ?>
        <div class="bulan-wrapper">
            <select class="bulan" onchange="changeMonth(this.value)">
                <?php foreach ($months as $num => $name): ?>
                    <option value="<?= $num ?>" <?= $num === $selected_month ? 'selected' : '' ?>>
                        <?= $name ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <script>
            function changeMonth(month) {
                const url = new URL(window.location.href);
                url.searchParams.set('month', month);
                window.location.href = url.toString();
            }
        </script>

        <?php 
        include "../koneksi.php";
        /** @var mysqli $koneksi */

        $query = mysqli_query($koneksi, "SELECT * FROM agenda WHERE MONTH(tanggal) = '$selected_month' ORDER BY tanggal ASC");
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
<?php if (!$included_in_admin) { ?>
</body>
</html>
<?php } ?>