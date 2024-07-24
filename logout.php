<?php
session_start();
$_SESSION = [];
session_unset();
session_destroy();
echo "<script>
        alert('Berhasil keluar');
        document.location.href='login.php';
    </script>";
