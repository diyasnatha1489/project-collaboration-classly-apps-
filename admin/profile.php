<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="../css/profile.css">
</head>
<body>
    <?php
    include '../koneksi.php';
    /**@var mysqli $koneksi */
    ?>
    <div class="content">
        <div class="profile">
            <img src="../picture/user-profile.jpg" alt="profile">
            <div class="edit-icon">Edit</div>
            <a href="logout.php">Log Out</a>
        </div>

        <div class="card">
            <div class="item">
                <span>Maula Qodri Lail</span>
                <span class="edit">Edit</span>
            </div>
            <div class="item">
                <span>maulaqodri6767@gmail.com</span>
                <span class="edit">Edit</span>
            </div>
            <div class="item">
                <span>*****************</span>
                <span class="edit">Edit</span>
            </div>
        </div>
    </div>
</body>
</html>

