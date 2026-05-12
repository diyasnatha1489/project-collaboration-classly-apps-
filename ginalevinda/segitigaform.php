<!DOCTYPE html>
<html lang="en">
<head></head>
<body>
<h2>Kalkulator Segitiga</h2>
    <form action="" method="POST">
     Alas :
     <input type="number" id="fname" name="alas"><br>
     Tinggi :
    <input type="number" id="1name" name="tinggi"><br>
     Sisi Miring :
    <input type="number" id="2name" name="sisi"><br><br>
    <input type="submit" value="Luas Segitiga" name="simpan"><br>
     <input type="submit" value="Keliling Segitiga" name="simpan2"><br>
    </form>

<?php
if(isset($_POST["simpan"])){
    $alas = $_POST ["alas"];
    $tinggi = $_POST ["tinggi"];
    $sisi = $_POST ["sisi"];
if (!empty($alas) && !empty($tinggi)) {
    $luas =1/2 * $alas * $tinggi;
    echo "<h3> Luas segitiganya adalah $luas</h3>";
    } else {
    echo "<p style='color:red;'> Harap isi terlebih dahulu.</p>";
}
}
if(isset($_POST["simpan2"])){
   $alas = $_POST ["alas"];
    $tinggi = $_POST ["tinggi"];
    $sisi = $_POST ["sisi"];
if (!empty($alas) && !empty($tinggi) && !empty($sisi)) {
    $keliling =$alas + $tinggi + $sisi;
    echo "<h3> Keliling segitiganya adalah $keliling</h3>";
    } else {
    echo "<p style='color:red;'> Harap isi terlebih dahulu.</p>";
}
}
?>
</body>
</html>