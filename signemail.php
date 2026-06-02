<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign With Email</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="form">
    <h2>Sign With Your Email</h2>
    <form action="" method="POST">
        <p>
            <div class="form-input">
            <label>Email:</label><br>
            <input type="email" name="femail" required placeholder="Masukkan email">
            </div>
        </p>
        <p>
            <div class="form-input">
            <label>Password:</label><br>
            <input type="password" name="fpassword" required placeholder="Masukkan password">
            </div>
        </p>
        <p>
            <button type="submit" name="benter" class="login-button">enter</button>
        </p>
    </form>
    </div>
    
    <?php
        if(isset($_POST["benter"])){
            $email = $_POST["femail"];
            $password =md5 ($_POST["fpassword"]);

            echo "<script>window.location.href='signname.php?email=$email&pass=$password';</script>";
        } 
    ?>
     <div class="background">
        <img src="picture/logo-transparan.png" alt="">
    </div>
</body>
</html>