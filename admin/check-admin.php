<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['ses_tipe'])) {
    header('location:../login.php?msg=login');
    exit();
}

if ($_SESSION['ses_tipe'] != 1) {
    echo "<script>alert('Maaf, kamu bukan admin.'); window.location.href = '../siswa/siswa.php';</script>";
    exit();
}
