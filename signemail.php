<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign With Email</title>
</head>
<body>
    <h2>Sign With Ur Email</h2>
    <div class="form">
    <form action="" method="POST">
        <p>
            <label>Email:</label><br>
            <input type="email" name="femail" required placeholder="Masukkan email...">
        </p>
        <p>
            <label>Password:</label><br>
            <input type="password" name="fpassword" required placeholder="Masukkan password...">
        </p>
        <p>
            <input type="submit" name="benter" value="enter">
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
</body>
</html>