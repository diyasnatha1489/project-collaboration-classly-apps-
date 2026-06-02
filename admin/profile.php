<?php
include "../koneksi.php";
/** @var mysqli $koneksi */

// Ensure user is logged in
if (!isset($_SESSION['ses_username']) || empty($_SESSION['ses_username'])) {
    echo '<p>Anda belum login. Silakan login terlebih dahulu.</p>';
    exit;
}

$username = mysqli_real_escape_string($koneksi, $_SESSION['ses_username']);

$profileName = 'Nama tidak ditemukan';
$profileEmail = 'Email tidak ditemukan';
$profilePassword = '*****************';
$profileImage = '../picture/user-profile.jpg';

// Load profile data
$q = mysqli_query($koneksi, "SELECT first_name, email, password FROM user WHERE username='" . $username . "'");
if ($q && mysqli_num_rows($q) > 0) {
    $row = mysqli_fetch_assoc($q);
    $profileName = htmlspecialchars($row['first_name'] ?: $_SESSION['ses_username']);
    $profileEmail = htmlspecialchars($row['email'] ?: 'Email tidak tersedia');
    $profilePassword = str_repeat('*', 15);
}

// Load profile image from filesystem if any exists
$safeUsername = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $username);
$profileDir = __DIR__ . '/../picture/profile/';
$profileFiles = glob($profileDir . $safeUsername . '_*');
if (!empty($profileFiles)) {
    $latest = end($profileFiles);
    if (file_exists($latest)) {
        $profileImage = '../picture/profile/' . basename($latest);
    }
}

// Handle photo upload (form posts to same page)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload_foto'])) {
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $tmp = $_FILES['foto']['tmp_name'];
        $mime = mime_content_type($tmp);
        $allowed = ['image/jpeg' => '.jpg', 'image/png' => '.png', 'image/webp' => '.webp'];
        if (!array_key_exists($mime, $allowed)) {
            $uploadError = 'Format gambar tidak didukung. Gunakan JPG/PNG/WebP.';
        } else {
            $ext = $allowed[$mime];
            $safeName = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $username);
            $targetDir = __DIR__ . '/../picture/profile/';
            if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
            $filename = $safeName . '_' . time() . $ext;
            $targetPath = $targetDir . $filename;
            if (move_uploaded_file($tmp, $targetPath)) {
                header('Location: admin.php?page=prfl');
                exit;
            } else {
                $uploadError = 'Gagal menyimpan file.';
            }
        }
    } else {
        $uploadError = 'Pilih file gambar terlebih dahulu.';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_nama'])) {

    $firstName = mysqli_real_escape_string(
        $koneksi,
        trim($_POST['first_name'])
    );

    mysqli_query(
        $koneksi,
        "UPDATE user
         SET first_name='$firstName'
         WHERE username='$username'"
    );

    header('Location: admin.php?page=prfl');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Profile Admin</title>
    <link rel="stylesheet" href="../css/profile.css">
    <style>
        .save-btn{margin-top:8px;padding:8px 12px;border-radius:6px}
        .edit-icon{cursor:pointer;display:inline-block;margin-left:8px}
        .profile img{width:140px;height:140px;border-radius:50%;object-fit:cover}
        .item input{width:60%;padding:6px}
    </style>
</head>
<body>
    <?php
    include 'check-admin.php';
    
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
            <form action="admin.php?page=prfl" method="POST" enctype="multipart/form-data">
                <div class="profile">
                    <img id="profilePreview" src="<?php echo $profileImage; ?>" alt="profile">
                    <input type="file" name="foto" id="foto" hidden accept="image/*" onchange="previewImage(this)">
                    <label for="foto" class="edit-icon">Edit Foto</label>
                    <button type="submit" name="upload_foto" class="save-btn">Simpan Foto</button>
                </div>

                <?php if (!empty($uploadError)): ?>
                    <p style="color:#b00"><?php echo htmlspecialchars($uploadError); ?></p>
                <?php endif; ?>
            </form>

            <div class="card">
                <div class="item">
                    <span><?php echo $profileName; ?></span>
                    <button type="button" class="edit" onclick="toggleDetail()">
                        Detail
                    </button>
                </div>

                <div id="detailNama" style="display:none;">
                    <form action="admin.php?page=prfl" method="POST">
                        <input type="text"
                            name="first_name"
                            value="<?php echo $profileName; ?>">

                        <button type="submit" name="update_nama">
                            Simpan
                        </button>
                    </form>
                </div>
                <div class="item">
                    <span><?php echo $profileEmail; ?></span>
                </div>
                <div class="item">
                    <span><?php echo $profilePassword; ?></span>
                </div>
                <div class="item">
                    <a href="./../logout.php">Log Out</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(input){
            const file = input.files && input.files[0];
            if(!file || !file.type.startsWith('image/')) return;
            const reader = new FileReader();
            reader.onload = function(e){
                document.getElementById('profilePreview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }

        function toggleDetail() {
            const detail = document.getElementById('detailNama');

            if(detail.style.display === 'none'){
                detail.style.display = 'block';
            } else {
                detail.style.display = 'none';
            }
        }
    </script>
</body>
</html>
