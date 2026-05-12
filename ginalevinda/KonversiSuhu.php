<html>
<head>
</head>
<body>
    <form method="POST" action="">
        <h3><b>Konversi Suhu</b></h3>
            <label>Masukan Derajat Celcius</label>
            <input type="number" name="Celcius" required><br><br>
             <label>Pilihan Konversi</label>
            <select name="Konversi">
                <option value=""></option>
                <option value="Farenheit">Farenheit</option>
                <option value="Kelvin">Kelvin</option>
            </select><br><br>
            <button type="submit" name="hitung">Hitung Jumlah</button>  <button type="reset" name="batal">Hapus</button> 
    </form>
<?php
    if(isset($_POST['hitung'])){
        $Celcius = $_POST ['Celcius'];
        $Konversi = $_POST ['Konversi'];

        if ($Konversi == "Farenheit"){
            $farenheit = (9/5 * $Celcius) + 32;
            echo "Derajat dalam $Konversi adalah $farenheit";
        } elseif ($Konversi == "Kelvin") {
            $kelvin = $Celcius + 273;
            echo "Derajat dalam $Konversi adalah $farenheit";
        } else {
            echo "Silahkan pilih Konversi terlebih dahulu";
        }
}
?>  
</body>
</html>