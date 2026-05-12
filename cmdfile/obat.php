<html>
    <head><tittle>Latihan Crud</tittle></head>
    <body>
        <h2>Data Obat</h2>
        <p><a href="obat.php"> Input Baru</a></p>
        <table border="1">
            <tr>
                <th>Nama Obat</th>
                <th>Harga Obat</th>
            </tr>
            <?php
                include "koneksi.php";
                mysqli_query("select * from obat;");
            ?>
        </table>
    </body>
</html>