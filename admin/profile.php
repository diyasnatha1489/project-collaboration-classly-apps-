<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="../css/pro.css">
</head>
<body>
    <?php
    include "../koneksi.php";
    /** @var mysqli $koneksi */

    $profileName = 'Nama tidak ditemukan';
    $profileEmail = 'Email tidak ditemukan';
    $profilePassword = '*****************';

    if(isset($_SESSION['ses_username']) && !empty($_SESSION['ses_username'])){
        $username = mysqli_real_escape_string($koneksi, $_SESSION['ses_username']);
        $query = mysqli_query($koneksi, "SELECT first_name, email, password FROM user WHERE username='" . $username . "'");
        if($query && mysqli_num_rows($query) > 0){
            $row = mysqli_fetch_assoc($query);
            $profileName = htmlspecialchars($row['first_name'] ?: $_SESSION['ses_username']);
            $profileEmail = htmlspecialchars($row['email'] ?: 'Email tidak tersedia');
            $profilePassword = str_repeat('*', 15);
        }
    } else {
        echo '<p>Anda belum login. Silakan login terlebih dahulu.</p>';
        exit;
    }
    ?>
    <div class="profile-container">
        <div class="content">
            <div class="profile">
                <img src="../picture/user-profile.jpg" alt="profile">
                <div class="edit-icon">Edit</div>
            </div>

            <div class="card">
                <div class="item">
                    <span><?php echo $profileName; ?></span>
                    <span class="edit">Edit</span>
                </div>
                <div class="item">
                    <span><?php echo $profileEmail; ?></span>
                    <span class="edit">Edit</span>
                </div>
                <div class="item">
                    <span><?php echo $profilePassword; ?></span>
                    <span class="edit">Edit</span>
                </div>
                <div class="item">
                    <a href="./../logout.php">Log Out</a>
                </div>   
            </div>
        </div>     
    </div>
</body>
</html>

