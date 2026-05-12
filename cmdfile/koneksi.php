<?php
$koneksi = mysqli_connect("localhost","root","", "apotek");

include "koneksi.php";
$query=mysqli_query($koneksi,"select * from obat");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

     <table border="1">
        <tr>
            <th>ID Obat</th>
            <th>Nama Obat</th>
            <th>Harga</th>
        </tr>
<?php
     while($data=mysqli_fetch_array($query)){
?>
            <tr>
                <td><?php echo $data["id_obat"];?></td>
                <td><?php echo $data["nama_obat"];?></td>
                <td><?php echo $data["harga"];?></td>
            </tr>
            <?php } ?>
    </table>
</body>
</html>