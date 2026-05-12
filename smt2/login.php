<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membuat Log In</title>
</head>
<body>
    <form action="" method="POST">
        <table>
            <tr><td>Username</td><td><input type="text" name="fusername"></td></tr>
            <tr><td>Password</td><td><input type="password" name="fpassword"></td></tr>
            <tr><td><input type="submit" name="flogin" value="Log In"></td></tr>
        </table>
    </form>
<?php
    session_start();

    include "koneksi.php";

    if(isset($_POST["flogin"])){
        $username=$_POST["fusername"];
        $password=md5($_POST["fpassword"]);

        $query=mysqli_query($koneksi, "select * from user where username='$username' and password='$password'");
        $cek=mysqli_num_rows($query);

        if($cek==1){
            $data=mysqli_fetch_array($query);
            $_SESSION["ses_uname"]=$data["username"];

            header('location:admin.php');
        } else {
            echo "Username/Password Salah!";
        }
    }

?>
</body>
</html>