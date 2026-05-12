<html>
    <head></head>
<body>
    <form method="POST" action="">
        <label> Nama Karyawan </label>
        <input type="text" name="nama"><br><br>
        <label> Status Pernikahan </label>
        <select name="status">
            <option value=""></option>
            <option value="nikah">Menikah </option>
            <option value="belum">Belum Menikah</option>
        </select><br><br>
        <label>Gaji Pokok</label>
        <input type="number" name="gaji"><br><br>
        <button type="submit" name="hitung">Hitung</button><br>
    </form>
<?php
    if(isset($_POST['hitung'])){
        $nama = $_POST ['nama'];
        $status = $_POST ['status'];
        $gaji = $_POST ['gaji'];7
        if ($status == "nikah") {
            $gajinikah = $gaji + ($gaji * 0.010) - ($gaji * 0.04);
            echo "Total Pendapatan $nama Rp. $gajinikah";
        } elseif ($status == "belum"){
            $gajibelumnikah = $gaji - ($gaji * 0.02);
            echo "Total Pendapatan $nama Rp. $gajibelumnikah";
        }
    }
?>
</body>
</html>