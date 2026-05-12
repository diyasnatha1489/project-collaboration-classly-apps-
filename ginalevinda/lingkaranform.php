<!DOCTYPE html>
<html lang="en">
<head></head>
<body>
<h2>Kalkulator Lingkaran</h2>
    <form action="" method="POST">
     phi : 3.14 <br>
     jari jari :
    <input type="number" id="1name" name="jarijari"><br><br>
    <input type="submit" value="Luas Lingkaran" name="simpan"><br>
     <input type="submit" value="Keliling Lingkaran" name="simpan2"><br>
    </form>

<?php
if(isset($_POST["simpan"])){
    $phi = 3.14;
    $jarijari = $_POST ["jarijari"];
    if (!empty($jarijari)) {
    $luaslingkaran = $phi * ($jarijari * $jarijari);
    echo "<h3> Luas lingkarannya adalah $luaslingkaran</h3>";
    } else {
    echo "<p style='color:red;'> Harap isi jari jari terlebih dahulu.</p>";
}
}
if(isset($_POST["simpan2"])){
    $phi = 3.14;
    $jarijari = $_POST ["jarijari"];
if (!empty($jarijari)) {
    $keliling = 2 * $phi * $jarijari;
    echo "<h3>Keliling lingkarannya adalah $keliling</h3>";
    } else {
    echo "<p style='color:red;'> Harap isi jari jari terlebih dahulu.</p>";
}
}
?>
</body>
</html>