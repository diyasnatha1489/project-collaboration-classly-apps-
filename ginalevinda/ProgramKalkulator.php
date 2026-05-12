<!DOCTYPE html>
<html>
<head>
    <title>Program Kalkulator</title>
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
            <h3><b>Program Kalkulator</b></h3>
            <label>Bilangan 1</label>
            <input type="number" name="bilangan1" required><br><br>
             <label>Operator</label>
            <select name="operator">
                <option value="">Pilih Operator</option>
                <option value="ditambah">+ (tambah)</option>
                <option value="dikurang">- (kurang)</option>
                <option value="dikali">* (kali)</option>
                <option value="dibagi">/ (bagi)</option>
            </select><br><br>
            <label>Bilangan 2</label>
            <input type="number" name="bilangan2" required><br><br>
            <button type="submit" name="hitung">Hitung Jumlah</button>  <button type="reset" name="batal">Hapus</button> 
        </form>
    <div class="result">
<?php
    if (isset($_POST['hitung'])) {
         $bil1 = ($_POST['bilangan1']);
         $operasi = $_POST['operator'];
         $bil2 = $_POST['bilangan2'];
        
        if ($operasi == "ditambah") {
             $jumlah = $bil1 + $bil2;
         } elseif ($operasi == "dikurang") {
             $jumlah = $bil1 - $bil2;
         } elseif ($operasi == "dikali") {
             $jumlah = $bil1 * $bil2;
         } elseif ($operasi == "dibagi") {
             $jumlah = $bil1 / $bil2;
         } {
             echo "Hasil perhitungan $bil1 $operasi $bil2 = $jumlah" ;
         }
    }
?>
        </div>
    </div>
</body>
</html>