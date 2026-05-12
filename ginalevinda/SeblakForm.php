<!DOCTYPE html>
<html>
<head>
    <title>Seblak HuhhhAHHH</title>
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
            <h3><b>Aplikasi Pemesanan Seblak HuuHahh</b></h3>
            <label>Nama Pemesan</label>
            <input type="text" name="nama_pemesan" required><br><br>
            <label>Harga </label>
            <input type="number" name="harga" required><br><br>
            <label>Level</label>
            <select name="level">
                <option value="">Pilih Level</option>
                <option value="tidak">Tidak Pedas</option>
                <option value="pedas">Pedas</option>
                <option value="ekstra">Ekstra Pedas</option>
            </select><br><br>
            <button type="submit" name="hitung">Hitung</button>  <button type="reset" name="batal">Batal</button> 
        </form>
    <div class="result">
<?php
    if (isset($_POST['hitung'])){
         $nama = ($_POST['nama_pemesan']);
         $harga = $_POST['harga'];
         $level = $_POST['level'];

        if ($level == "ekstra") {
             $harga += $harga * 0.10;
         } elseif ($level == "pedas") {
            $harga += $harga * 0.05;
         }
            echo "Total Pesanan $nama adalah Rp." . number_format($harga, 0, ',', '.') ;
        
    } 
?>
        </div>
    </div>
</body>
</html>