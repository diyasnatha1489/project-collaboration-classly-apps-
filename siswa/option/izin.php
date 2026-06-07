<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Today Attendance</title>
    <link rel="stylesheet" href="./../../css/izin.css">
</head>
<body>
    <?php
    
    if(session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    include __DIR__ . '/../../koneksi.php';

    if (isset($_POST['manualSubmit'])) {
        $username = '';
        if (!empty($_SESSION['ses_username'])) {
            $username = $_SESSION['ses_username'];
        } elseif (!empty($_SESSION['username'])) {
            $username = $_SESSION['username'];
        }

        if (empty($username)) {
            echo "<script>alert('Silakan login terlebih dahulu.'); window.location.href='../../login.php';</script>";
            exit;
        }
        $username = mysqli_real_escape_string($koneksi, $username);
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $status = isset($_POST['status']) && in_array($_POST['status'], ['Permit', 'Sick']) ? $_POST['status'] : 'Permit';

        // Cek apakah user sudah absen hari ini (prevent multiple attendance)
        $cek = mysqli_query($koneksi, "SELECT id FROM attendance WHERE username='". $username ."' AND date='". $date ."'");
        if ($cek && mysqli_num_rows($cek) > 0) {
            echo "<script>alert('Anda sudah melakukan absensi hari ini, tidak bisa mengirim permit/sick.'); window.location.href='../siswa.php?page=attd';</script>";
            exit;
        }

        $file_name = $_FILES['manualFile']['name'];
        $file_tmp = $_FILES['manualFile']['tmp_name'];
        $file_size = $_FILES['manualFile']['size'];
        $file_error = $_FILES['manualFile']['error'];

        $target_dir = "./../../upload/";

        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_extension = array("jpg", "jpeg", "png");
        
        if ($file_error === 4) {
            echo "<script>alert('Pilih file surat terlebih dahulu!'); window.location.href='';</script>";
            exit;
        }

        if (!in_array($file_ext, $allowed_extension)) {
            echo "<script>alert('Format file tidak didukung! Hanya boleh JPG, JPEG, PNG.'); window.location.href='';</script>";
            exit;
        }

        if ($file_size > 2000000) {
            echo "<script>alert('Ukuran file terlalu besar! Maksimal 2MB.'); window.location.href='';</script>";
            exit;
        }

        $new_file_name = "izin_" . time() . "_" . basename($file_name);
        $target_file = $target_dir . $new_file_name;

        if (move_uploaded_file($file_tmp, $target_file)) {
            $sql = "INSERT INTO attendance (`qr_code`, `username`, `date`, `time`, `status`, `surat`) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($koneksi, $sql);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, 'ssssss', $new_file_name, $username, $date, $time, $status, $new_file_name);
                $exec = mysqli_stmt_execute($stmt);
                if ($exec) {
                    echo "<script>alert('Surat izin berhasil diupload dan presensi berhasil dicatat!'); window.location.href='../siswa.php?page=attd'; </script>";
                } else {
                    $err = mysqli_stmt_error($stmt);
                    echo "<script>alert('Gagal menyimpan data ke database: ". addslashes($err) ."'); window.location.href=''; </script>";
                }
                mysqli_stmt_close($stmt);
            } else {
                $err = mysqli_error($koneksi);
                echo "<script>alert('Gagal menyiapkan query: ". addslashes($err) ."'); window.location.href=''; </script>";
            }
        
        } 
        else {
            echo "<script>alert('Gagal mengupload file ke server. Pastikan folder uploads sudah dibuat!'); window.location.href=''; </script>";
        }
    }
    
    ?>
    <div class="permit">
        <div class="permit-header">
            <h1>Upload Surat Izin</h1>
        </div>
        <div class="manual-input">
            <form action="" method="post" enctype="multipart/form-data">
                <label for="status">Status</label> <br/>
                <select id="status" name="status" required>
                    <option value="Permit">Permit</option>
                    <option value="Sick">Sick</option>
                </select> <br/>
                <label for="manualFile">Pilih File Surat</label>
                <input type="file" id="manualFile" name="manualFile" accept="image/*" required />
                <button id="manualSubmit" name="manualSubmit" type="submit">Kirim File</button>
            </form>
        </div>
        <button class="back-button" onclick="window.location.href='../siswa.php?page=attd'">Kembali</button>
    </div>
</body>
</html>