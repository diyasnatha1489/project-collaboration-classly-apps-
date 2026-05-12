<!DOCTYPE html>
<html>
<head>
    <title>Aplikasi Toko Online</title>
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
        input[type="text"], input[type="number"] {
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
        }
    </style>
</head>
<body>
    <div class="container">
        <form method="post">
            <h3><b>Aplikasi Toko Online</b></h3>
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" required><br><br>
            <label>Harga Barang</label>
            <input type="number" name="harga_barang" required><br><br>
            <label>Jumlah Barang</label>
            <input type="number" name="jumlah_barang" required><br><br>
            <button type="submit" name="hitung">Hitung</button>  <button type="reset" name="batal">Batal</button> 
        </form>
    <div class="result">
            <?php
            if (isset($_POST['hitung'])) {
                $nama = $_POST['nama_barang'];
                $harga = $_POST['harga_barang'];
                $jumlah = $_POST['jumlah_barang'];

                if ($harga >= 0 && $jumlah >= 0) {
                    $total = $harga * $jumlah;
                    echo "Total Harga <b>$nama</b> adalah Rp " . number_format($total, 0, ',', '.');
                } else {
                    echo "Masukkan harga dan jumlah yang valid!";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>