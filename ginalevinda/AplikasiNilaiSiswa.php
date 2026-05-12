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
            <h3><b>Aplikasi Nilai PKL</b></h3>
            <label>Nama Siswa</label>
            <input type="text" name="nama_siswa" required><br><br>
            <label>Keterampilan</label>
            <input type="number" name="keterampilan" required><br><br>
            <label>Sikap</label>
            <input type="number" name="sikap" required><br><br>
            <label>Kinerja</label>
            <input type="number" name="kinerja" required><br><br>
            <button type="submit" name="hitung">Hitung</button>  <button type="reset" name="batal">Batal</button> 
        </form>
    <div class="result">
<?php
    if (isset($_POST['hitung'])){
         $nama = ($_POST['nama_siswa']);
         $keterampilan = $_POST['keterampilan'];
         $sikap = $_POST['sikap'];
         $kinerja = $_POST['kinerja'];
         
        $total = ($keterampilan + $sikap + $kinerja) / 3;
         echo "Nilai di sertifikat $nama adalah $total";
    } 
?>
        </div>
    </div>
</body>
</html>