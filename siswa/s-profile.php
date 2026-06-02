<?php
include "../koneksi.php";

if (!isset($_SESSION['ses_username']) || empty($_SESSION['ses_username'])) {
    echo '<p>Anda belum login. Silakan login terlebih dahulu.</p>';
    exit;
}

$username = htmlspecialchars($_SESSION['ses_username']);
$defaultImage = '../picture/user-profile.jpg';
$uploadDir = dirname(__DIR__) . '/picture/profile';
$profileMessage = '';
$profileImage = $defaultImage;
$firstName = $username; // default to username if not found

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$safeUsername = preg_replace('/[^a-zA-Z0-9_-]/', '_', $_SESSION['ses_username']);
$existingFiles = glob($uploadDir . '/' . $safeUsername . '.*');

if (!empty($existingFiles) && file_exists($existingFiles[0])) {
    $profileImage = '../picture/profile/' . basename($existingFiles[0]);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile_photo'])) {
    if (!isset($_FILES['profile_image']) || $_FILES['profile_image']['error'] !== UPLOAD_ERR_OK) {
        $profileMessage = 'Pilih gambar terlebih dahulu.';
    } else {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
        $fileType = mime_content_type($_FILES['profile_image']['tmp_name']);

        if (!in_array($fileType, $allowedTypes, true)) {
            $profileMessage = 'Format gambar harus JPG, PNG, atau WebP.';
        } else {
            $extension = $fileType === 'image/jpeg' ? '.jpg' : ($fileType === 'image/png' ? '.png' : '.webp');
            $targetFile = $uploadDir . '/' . $safeUsername . $extension;

            if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $targetFile)) {
                $profileImage = '../picture/profile/' . $safeUsername . $extension;
                $profileMessage = 'Foto profil berhasil diperbarui.';
            } else {
                $profileMessage = 'Gagal mengunggah foto profil.';
            }
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_nama'])) {

    $newFirstName = mysqli_real_escape_string(
        $koneksi,
        trim($_POST['first_name'])
    );

    mysqli_query(
        $koneksi,
        "UPDATE user
         SET first_name='$newFirstName'
         WHERE username='$username'"
    );

    // Update successful, message akan ditampilkan
    $profileMessage = 'Nama profil berhasil diperbarui.';
    $firstName = $newFirstName; // Update display
}

// Load first_name from database
$query = mysqli_query($koneksi, "SELECT first_name FROM user WHERE username='$username'");
if ($query && mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_assoc($query);
    if (!empty($row['first_name'])) {
        $firstName = htmlspecialchars($row['first_name']);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile Siswa</title>

  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #f2f2f2;
    }

    .container {
      min-height: 100vh;
      background: white;
      padding: 24px 20px 40px;
      text-align: center;
      box-sizing: border-box;
    }

    .profile-img {
      width: 130px;
      height: 130px;
      border-radius: 50%;
      object-fit: cover;
      display: block;
      margin: 0 auto;
      border: 4px solid #f3de92;
    }

    .profile-photo-wrap {
      position: relative;
      display: inline-block;
      cursor: pointer;
      margin-bottom: 12px;
    }

    .edit-badge {
      position: absolute;
      right: 0;
      bottom: 6px;
      background: #f3de92;
      color: #000;
      border-radius: 999px;
      padding: 6px 12px;
      font-size: 12px;
      font-weight: 700;
      border: 2px solid #fff;
    }

    .title {
      font-size: 22px;
      letter-spacing: 1px;
      margin: 10px 0 20px;
    }

    .card {
      background: #f3de92;
      border-radius: 30px;
      padding: 24px 16px;
      max-width: 480px;
      margin: 0 auto;
      text-align: left;
    }

    .item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 14px 0;
      border-bottom: 3px solid #f0f0f0;
      font-size: 18px;
      gap: 12px;
    }

    .item:last-child {
      border-bottom: 0;
    }

    .item span {
      word-break: break-word;
    }

    .logout {
      margin-top: 24px;
      text-align: center;
    }

    .logout a {
      text-decoration: underline;
      color: black;
      font-size: 20px;
      font-weight: bold;
    }

    .hidden-input {
      display: none;
    }

    .upload-form {
      margin-bottom: 20px;
    }

    .upload-note {
      margin: 8px 0 0;
      font-size: 13px;
      color: #555;
    }

    .profile-message {
      margin: 12px auto 0;
      max-width: 430px;
      border-radius: 12px;
      padding: 10px 12px;
      font-size: 14px;
      background: #eefbf1;
      color: #1f6f43;
    }

    .save-photo-btn {
      margin-top: 12px;
      border: 0;
      border-radius: 999px;
      padding: 10px 18px;
      background: #000;
      color: #fff;
      font-weight: 700;
      cursor: pointer;
    }

    .save-photo-btn:hover {
      opacity: 0.9;
    }
  </style>
</head>
<body>
  <div class="container">
    <form action="" method="post" enctype="multipart/form-data" class="upload-form" id="profileForm">
      <label for="profileImageInput" class="profile-photo-wrap" aria-label="Klik untuk mengganti foto profil">
        <img src="<?= $profileImage; ?>" alt="Foto profil <?= $username; ?>" class="profile-img" id="profilePreview">
        <span class="edit-badge">Edit</span>
      </label>
      <input type="file" name="profile_image" id="profileImageInput" class="hidden-input" accept="image/*">
      <input type="hidden" name="update_profile_photo" value="1">
      <p class="upload-note">Klik foto untuk memilih gambar baru</p>
      <button type="submit" class="save-photo-btn">Simpan foto</button>
    </form>

    <h2 class="title">PROFILE SISWA</h2>

    <div class="card">
     <div class="item">
        <span><?php echo $firstName; ?></span>
        <button type="button" class="edit" onclick="toggleDetail()">
            Detail
        </button>
    </div>

    <div id="detailNama" style="display:none;">
        <form action="" method="POST">
            <input type="text"
                  name="first_name"
                  value="<?php echo $firstName; ?>">

            <button type="submit" name="update_nama">
                Simpan
            </button>
        </form>
    </div>

      <div class="item">
        <span>email</span>
        <span>Terdaftar</span>
      </div>

      <div class="item">
        <span>password</span>
        <span>********</span>
      </div>

      <div class="logout">
        <a href="../logout.php">LOGOUT</a>
      </div>
    </div>

    <?php if (!empty($profileMessage)): ?>
      <p class="profile-message"><?= htmlspecialchars($profileMessage); ?></p>
    <?php endif; ?>
  </div>

  <script>
    const fileInput = document.getElementById('profileImageInput');
    const previewImage = document.getElementById('profilePreview');
    const profileForm = document.getElementById('profileForm');

    if (fileInput && previewImage) {
      fileInput.addEventListener('change', function () {
        const file = this.files && this.files[0];

        if (!file) {
          return;
        }

        if (!file.type.startsWith('image/')) {
          alert('Pilih file gambar yang valid.');
          this.value = '';
          return;
        }

        const reader = new FileReader();
        reader.onload = function (event) {
          previewImage.src = event.target.result;
        };
        reader.readAsDataURL(file);
      });
    }

    if (profileForm) {
      profileForm.addEventListener('submit', function () {
        const file = fileInput && fileInput.files && fileInput.files[0];

        if (!file) {
          alert('Pilih gambar terlebih dahulu sebelum menyimpan.');
          return false;
        }
      });
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