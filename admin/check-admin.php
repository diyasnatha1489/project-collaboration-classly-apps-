<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['ses_tipe'])) {
    header('location:../login.php?msg=login');
    exit();
}

if ($_SESSION['ses_tipe'] != 1) {
    echo "<script>";
    echo "alert('Maaf, kamu bukan admin.');";
    echo "var target = document.referrer && document.referrer.indexOf(location.origin) === 0 ? document.referrer : '../siswa/siswa.php';";
    echo "window.location.href = target;";
    echo "</script>";
    exit();
}
