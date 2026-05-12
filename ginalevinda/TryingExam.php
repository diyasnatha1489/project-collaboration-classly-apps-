<html lang="en">
<head>
    <tittle>DISKON 5%</tittle>
</head>
<body>
    <form method="POST" action="">
        Nama Barang<input type="text" name="fname"><br>
        Harga <input type="number" name="fharga"><br><br>
        <input type="submit" name="Hitung">
    </form>
</body>
</html>
    
<?php
    if(isset($_POST['Hitung'])) {
        $nama= $_POST ['fname'];
        $harga= $_POST ['fharga'];
        $diskon= $harga * 0.05;
   if (!empty($nama) && !empty($harga)) 
        $total= $harga - $diskon;
        echo "Nama Barang: $nama <br>";
        echo "Harga Diskon: Rp". number_format ($total, 0, ',', '.');
    }
?>