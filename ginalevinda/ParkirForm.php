<!DOCTYPE html>
<html>
<head>
    <title>Nilai PKL</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 350px;
            border: 1px solid #000;
            padding: 15px;
            border-radius: 5px;
        }
        h3 {
            margin-top: 0;
        }
        label {
            display: inline-block;
            width: 120px;
        }
        input[type="text"], input[type="number"], select {
            width: 180px;
            padding: 5px;
        }
        button {
            padding: 5px 15px;
            margin-top: 10px;
            cursor: pointer;
        }
        .result {
            margin-top: 15px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
    <form method="post">
        <h3>Aplikasi Parkir Kendaraan<h3>
            <label>Nama</label>
            <input type="text" name="nama" required><br><br>
            <label>Jumlah Hari</label>
            <input type="number" name="hari" required><br><br>
            <label>Jenis Kendaraan</label>
            <select name="kendaraan">
                <option value="">Pilih Jenis</option>
                <option value="mobil">Mobil</option>
                <option value="motor">Motor</option>
                <option value="sepeda">Sepeda</option>
            </select><br><br>
            <button type="submit" name="hitung">Hitung</button>  <button type="reset" name="">Batal</button>
    </form>
    <div class="result">
</body>
</html>
<?php
if(isset($_POST['hitung'])){
    $nama = $_POST ['nama'];
    $hari = $_POST ['hari'];
    $jenis = $_POST ['kendaraan'];

    if($jenis == "mobil"){
        $mobil = 10000 * $hari;
        echo "Total biaya parkir $nama selama $hari hari adalah Rp". number_format($mobil, 0, ',', '.');
    } elseif($jenis == "motor"){
        $motor = 5000 * $hari;
        echo "Total biaya parkir $nama selama $hari hari adalah Rp". number_format($motor, 0, ',', '.');
    } elseif($jenis == "sepeda"){
        $sepeda = 2000 * $hari;
        echo "Total biaya parkir $nama selama $hari hari adalah Rp". number_format($sepeda, 0, ',', '.');
    }
}
?>