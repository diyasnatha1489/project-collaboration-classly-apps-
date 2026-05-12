<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>aplikasi hitung zakat penghasilan</h2>
    <form action= "" method="POST">
        <tr>
            <td>nama muzaki</td>
            <td><input type= "text" id= "fname" name= "namamuzaki"></td><br>
        </tr>
        <tr>
            <td>jumlah penghasilan</td>
            <td><input type= "number" id = "fname" name= "jumlahpenghasilan"><td><br>
        </tr>
        <tr>
            <td><input type ="submit"value ="hitung"name ="hitung"></td>
        </tr>
    </form>
</body>
</html>
<?php
if(isset($_POST["hitung"])){
    $namamuzaki = $_POST["namamuzaki"];
    $jumlahpenghasilan = $_POST["jumlahpenghasilan"];
    $hasil = $jumlahpenghasilan * 0.025;
    
    echo "<p> jumlah zakat yang harus ditunaikan $namamuzaki adalah Rp.$hasil</p>";
    
}
?>