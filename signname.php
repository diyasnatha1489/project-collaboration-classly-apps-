<?php
session_start();
include "koneksi.php";

$email = isset($_GET['email']) ? htmlspecialchars($_GET['email'], ENT_QUOTES, 'UTF-8') : '';
$password = isset($_GET['password']) ? htmlspecialchars($_GET['password'], ENT_QUOTES, 'UTF-8') : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Detail</title>
</head>
<body>
    <h2>Sign Up</h2>
    <form action="" method="POST">
        <input type="hidden" name="femail" value="<?php echo $_GET['email'] ?? ''; ?>">
        <input type="hidden" name="fpassword" value="<?php echo $_GET['pass'] ?? ''; ?>">
        <p>
            <label>Username:</label><br>
            <input type="text" name="fusername" required placeholder="Masukkan username...">
        </p>
        <p>
            <label>Tipe User:</label><br>
            <select name="ftipe" required>
                <option value="">Anda Adalah</option>
                <option value="1">Admin</option>
                <option value="2">Siswa</option>
            </select>
        </p>
        <p>
            <label>Class Code</label><br>
            <input type="text" name="fcode" placeholder="Masukkan kode kelas (untuk siswa)...">
        </p>
        <p>
            <input type="submit" name="bconfirm" value="Confirm">
        </p>
    </form>
    <?php
        if(isset($_POST["bconfirm"])){
            $email = $_POST["femail"];
            $password = $_POST["fpassword"];
            $username = $_POST["fusername"];
            $code = $_POST["fcode"];
            $tipe_user = $_POST["ftipe"];
            
        if (empty($email) || empty($password)) {
            echo "<script>alert('Akses ditolak! Silahkan isi email dan password terlebih dahulu');window.location.href='signemail.php';</script>";
            exit();
        }
        
        if (empty($tipe_user)) {
            echo "<script>alert('Pilih tipe user terlebih dahulu!');</script>";
            exit();
        }

        $username = strtolower(str_replace(' ', '', $username));
        $username = mysqli_real_escape_string($koneksi, $username);
        $password = mysqli_real_escape_string($koneksi, $password);
        $code = mysqli_real_escape_string($koneksi, $code);
        $email = mysqli_real_escape_string($koneksi, $email);
        
        // cek usn (ganti klo dah adaa)
        $cek_username = mysqli_query($koneksi, "SELECT username FROM user WHERE username='$username'");
        if (mysqli_num_rows($cek_username) > 0) {
            echo "<script>alert('Username sudah terdaftar. Silahkan gunakan username lain.');</script>";
            exit();
        }
        
        // admin: perlu code sama buat kelas baru, klo siswa perlu code buat join kelas
        if ($tipe_user == 1) {
           if (empty($code)) {
               echo "<script>alert('Masukkan kode kelas yang ingin Anda buat sebagai admin!');</script>";
               exit();
           }

           // pemastian kode kelas blum dipakai admin lain
           $cek_room_admin = mysqli_query($koneksi, "SELECT * FROM kelas WHERE class_code='$code'");
           if (mysqli_num_rows($cek_room_admin) > 0) {
               echo "<script>alert('Kode kelas sudah digunakan. Silakan pilih kode lain.');</script>";
               exit();
           }

           // buat record kelas baru
           $insert_kelas = mysqli_query($koneksi, "INSERT INTO kelas (class_code, nama_kelas) VALUES ('$code', '$username')");
           if (!$insert_kelas) {
               echo "<script>alert('Gagal membuat kelas. Silakan coba lagi.');</script>";
               exit();
           }

           // insert user admin baru with kode kelas nya
           $query = mysqli_query($koneksi, "INSERT INTO user (username, password, tipe, email, first_name, class_code) VALUES ('$username', '$password', '$tipe_user', '$email', '$username', '$code')");

           if ($query) {
               $_SESSION['username'] = $username;
               $_SESSION['tipe'] = $tipe_user;

               echo "<script>alert('Pendaftaran berhasil! Kode kelas: $code');window.location.href='admin/admin.php';</script>";
           } else {
               echo "<script>alert('Gagal mendaftar. Silakan coba lagi.');</script>";
           }
        }
        // siswa, perlu code kelas
        else if ($tipe_user == 2) {
            if (empty($code)) {
                echo "<script>alert('Kode kelas harus diisi untuk siswa!');</script>";
                exit();
            }
            
            $cek_room = mysqli_query($koneksi, "SELECT * FROM kelas WHERE class_code='$code'");

            if (mysqli_num_rows($cek_room) > 0) {
               $query = mysqli_query($koneksi, "INSERT INTO user (username, password, tipe, email, first_name, class_code) VALUES ('$username', '$password', '$tipe_user', '$email', '$username', '$code')");

               if ($query) {
                   $_SESSION['username'] = $username;
                   $_SESSION['tipe'] = $tipe_user;
                   $_SESSION['class_code'] = $code;

                   echo "<script>alert('Pendaftaran berhasil!');window.location.href='siswa/siswa.php';</script>";
               } else {
                   echo "<script>alert('Gagal mendaftar. Silakan coba lagi.');</script>";
               }
            } else {
                echo "<script>alert('Kode kelas tidak ditemukan.');</script>";
            }
        }
        }
    ?>
</body>
</html>