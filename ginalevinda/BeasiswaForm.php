<!DOCTYPE html>
<html>
<head>
    <title>BEASISWA</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 500px;
            border: 1px solid #000;
            padding: 15px;
            border-radius: 5px;
        }
        h3 {
            margin-top: 0;
        }
        label {
            display: inline-block;
            width: 200px;
        }
        input[type="text"], input[type="number"], select {
            width: 200px;
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
        <h3>Aplikasi Jenis Beasiswa<h3>
            <label>Nama Mahasiswa</label>
            <input type="text" name="nama" required><br><br>
            <label>Nilai Rata Rata</label>
            <input type="number" name="nilai" required><br><br>
            <label>Penghasilan Orang Tua/bulan</label>
            <input type="number" name="gaji" required><br><br>
            <label>Prestasi</label>
            <select name="prestasi">
                <option value="">Pilih Jenis Prestasi</option>
                <option value="nothing">Tidak Ada</option>
                <option value="sekolah">Tingkat Sekolah</option>
                <option value="kota">Tingkat Kota</option>
                <option value="provinsi">Tingkat Provinsi</option>
                <option value="nasional">Tingkat Nasional</option>
                <option value="internasional">Tingkat Internasional</option>
            </select><br><br>
            <label>Semester Saat Ini</label>
            <input type="number" name="semester" required><br><br>
            <button type="submit" name="hitung">Hitung</button>  <button type="reset" name="">Batal</button>
    </form>
    <div class="result">
</body>
</html>
<?php
if(isset($_POST['hitung'])) {
    $nama = $_POST ['nama'];
    $nilai = $_POST ['nilai'];
    $penghasilan = $_POST ['gaji'];
    $prestasi = $_POST ['prestasi'];
    $semester = $_POST ['semester'];

    if($nilai >= 90 &&
     $penghasilan <= 3000000 &&
     $prestasi == "nasional" || $prestasi == "internasional"){
        echo "Selamat, $nama! Kamu memenuhi syarat untuk mendapatkan <b>Beasiswa A<b>";
    } elseif($nilai >= 85 &&
     $penghasilan <= 4000000 &&
     $prestasi == "provinsi" || $prestasi == "nasional" || $prestasi == "internasional"){
        echo "Selamat, $nama! Kamu memenuhi syarat untuk mendapatkan <b>Beasiswa B<b>";
    } elseif($nilai >= 80 &&
     $penghasilan <= 5000000 &&
     $semester <= 6){
        echo "Selamat, $nama! Kamu memenuhi syarat untuk mendapatkan <b>Beasiswa C<b>";
    } elseif($nilai >= 80 &&
     $penghasilan <= 6000000 &&
     $prestasi !== "nothing"){
        echo "Selamat, $nama! Kamu memenuhi syarat untuk mendapatkan <b>Beasiswa D<b>";
     } elseif($nilai >= 90 &&
     $semester <= 4){
        echo "Selamat, $nama! Kamu memenuhi syarat untuk mendapatkan <b>Beasiswa E<b>";
     } elseif ($nilai >= 85 &&
     $prestasi == "provinsi" ||
     $prestasi == "internasional"){
        echo "Selamat, $nama! Kamu memenuhi syarat untuk mendapatkan <b>Beasiswa F<b>";
     } elseif($nilai >= 90 &&
     $penghasilan <= 7000000){
        echo "Selamat, $nama! Kamu memenuhi syarat untuk mendapatkan <b>Beasiswa G<b>";
     } elseif($nilai >= 85 &&
     $semester <= 2 &&
     $penghasilan <= 4000000){
        echo "Selamat, $nama! Kamu memenuhi syarat untuk mendapatkan <b>Beasiswa H<b>";
     } elseif($nilai >= 90 &&
     $penghasilan <= 10000000 &&
     $prestasi == "nothing"){
        echo "Selamat, $nama! Kamu memenuhi syarat untuk mendapatkan <b>Beasiswa I<b>";
     } elseif($nilai >= 90 &&
     $penghasilan <= 2000000){
        echo "Selamat, $nama! Kamu memenuhi syarat untuk mendapatkan <b>Beasiswa J<b>";
     }
}
?>