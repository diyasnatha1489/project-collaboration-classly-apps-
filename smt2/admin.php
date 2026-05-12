<?php
session_start();

if(isset($_SESSION['ses_uname'])=='admin'){
?>

Ini halaman admin. <a href="logout.php">Log Out</a>

<?php

} else {
    echo "Anda belum login, silahkan login terlebih dahulu";
}
?>