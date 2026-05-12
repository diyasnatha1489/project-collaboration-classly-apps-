<!DOCTYPE html>
<html>
<head>
    <title>Pendaftaran Ekstrakulikuler</title>
</head>
<body>
<h2>Masukan Identitas Anda</h2>
<form action="" method="POST">
<pre>
     Nama               :<Input type="text" id="fname" name="nama">
     Kelas              :<select name="kelas" id="">
                            <option value="X PM 1">X PM 1</option>
                            <option value="X PM 2">X PM 2</option>
                            <option value="X PM 3">X PM 3</option>
                            <option value="XI PM 1">XI BR</option>
                            <option value="XI PM 2">XI BD 1</option>
                            <option value="XI PM 3">XI BD 2</option>
                            <option value="XI RPL 1">XI RPL 1</option>
                            <option value="XI RPL 2">XI RPL 2</option>
                            <option value="XI RPL 3">XI RPL 3</option>
                            <option value="XI TBSM 1">XI TBSM 1</option>
                            <option value="XI TBSM 2">XI TBSM 2</option>
                            <option value="XI TO 3">XI TBSM 3</option>
                            <option value="XI TO 4">XI TBSM 4</option>
                            <option value="XI TF">XI FKK</option>
                        </select>
     Alamat             :<textarea name="alamat" row="5" cols="40"></textarea>
     Tanggal Lahir      :<Input type="date" id="3name" name="date">
     Jenis Kelamin      :<input type="radio" id="male" name="gender" value="Laki-laki" <?php if(isset($_POST['gender']) == 'male') echo 'checked'; ?> checked><label for="male">Laki-laki</label>
                         <input type="radio" id="female" name="gender" value="Perempuan" <?php if(isset($_POST['gender']) == 'female') ?>><label for="female">Perempuan</label>
     No. Telp           :<Input type="number" id="2name" name= "Telp"><br><br>
<input type="submit" value="DAFTAR" name="simpan"> <input type="reset" value="BATAL">
</pre>
</form>
<?php
if(isset($_POST["simpan"])){
    $nama = $_POST["nama"];
    $kelas = $_POST["kelas"];
    $alamat = $_POST["alamat"];
    $tanggallahir = $_POST["date"];
    $gender = $_POST["gender"];
    $telp = $_POST["Telp"];
    if (!empty($nama) && !empty($kelas) && !empty($alamat) && !empty($tanggallahir) && !empty($gender) && !empty($telp)) {
        echo "<h3>Selamat datang $nama dari kelas $kelas!</h3>";
        echo "<table border=1 cellspacing=0 cellpadding=5>
                    <tr>
                       <th>Nama</th>
                       <th>Kelas</th>
                       <th>Alamat</th>
                       <th>Tanggal Lahir</th>
                       <th>Gender</th>
                       <th>No. Telp</th>
                    </tr>
                    <tr>
                       <td>$nama</td>
                       <td>$kelas</td>
                       <td>$alamat</td>
                       <td>$tanggallahir</td>
                       <td>$gender</td>
                       <td>$telp</td>
                    </tr>
             </table>";
    } else {
        echo "<p style='color:red;'> Harap isi semua data terlebih dahulu. </p>";
    }
}
?>
</body>
</html>