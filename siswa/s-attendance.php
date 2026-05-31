<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./../css/s-att.css">
</head>
<body>
    <?php
        if(isset($_GET['kode'])){
            include __DIR__ . '/../koneksi.php';

            $kode_raw = $_GET['kode'];
            $kode = mysqli_real_escape_string($koneksi, $kode_raw);
            $username = isset($_SESSION['ses_username']) ? $_SESSION['ses_username'] : '';
            $date = date('Y-m-d');
            $time = date('H:i:s');

            if(empty($username)){
                $msg = 'User belum login';
            } else {
                // try to interpret kode as numeric id, otherwise store 0
                $id_qr = is_numeric($kode) ? intval($kode) : 0;

                // prevent duplicate attendance for same user and date
                $cek = mysqli_query($koneksi, "SELECT * FROM attendance WHERE username='". $username ."' AND date='". $date ."'");
                if($cek && mysqli_num_rows($cek) > 0){
                    $msg = 'Anda sudah absen hari ini';
                } else {
                    $ins = mysqli_query($koneksi, "INSERT INTO attendance (qr_code, username, date, time, status) VALUES ('". $id_qr ."', '". $username ."', '". $date ."', '". $time ."', 'Present')");
                    if($ins){
                        $msg = 'Absen berhasil';
                    } else {
                        $msg = 'Absen gagal: '. mysqli_error($koneksi);
                    }
                }
            }

            // show feedback and remove kode param to avoid re-submission
            echo "<script>alert('". addslashes($msg) ."'); window.location.href='siswa.php?page=attd';</script>";
            exit;
        }
    ?>
    <div class="today">
        <img src="./../picture/attendance.png" alt="">
        <table>
            <tr>
                <td>Profile Name</td>
                <td class="right">Maula Qodri Lail</td>
            </tr>
            <tr>
                <td>Date</td>
                <td class="right">Friday, Nov 14</td>
            </tr>
            <tr>
                <td>Expired Time</td>
                <td class="right">07.00 WIB</td>
            </tr>
        </table>
        <div class="option-button">
            <a href="option/scan.php">Scan Or Code</a>
            <a href="option/izin.php">Izin</a>
        </div>
    </div>
</body>
</html>