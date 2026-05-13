<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body> 
    <div class="form">
        <h2>Please Log In Here</h2>
        <form action="" method="POST">
            <div class="form-input">
                <label for="username">Username</label>
                <input type="text" name="fusername">
            </div>
            <div class="form-input">
                <label for="password">Password</label>
                <input type="password" name="fpassword" id="">
            </div>
            <button type="submit" name="flogin" class="login-button">Login</button>
        </form>   
        <p>-or-</p>
        <div class="alternatif-option">
            <img src="picture/logo.png" alt="">
            <img src="picture/logo.png" alt="">
            <img src="picture/logo.png" alt="">
        </div>
    </div>
    
    <?php
        session_start();

        include "koneksi.php";
        if(isset($_POST["flogin"])){
            $username = $_POST["fusername"];
            $password = md5($_POST["fpassword"]);
            $query = mysqli_query($koneksi, "select * from user where username='$username' and password='$password'");
            $cek = mysqli_num_rows($query);

            if($cek==1){
                $data = mysqli_fetch_array($query);
                $_SESSION["ses_tipe"] = $data["tipe"];
  
                if($_SESSION['ses_tipe']==1){
                    header('location:admin/admin.php?page=dash');
                } elseif($_SESSION['ses_tipe']==2){
                    header('location:siswa/siswa.php?page=attd&section=today');
                } else{
                    echo "User tidak ditemukan";
                }
            } else {
                echo "Username/Password Salah";
            }
        }
    ?>
    <div class="background">
        <img src="picture/logo-transparan.png" alt="">
    </div>
</body>
</html>