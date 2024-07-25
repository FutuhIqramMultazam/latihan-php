<?php
session_start();
$_SESSION = [];
session_unset();
session_destroy();

// logout untuk cookie
setcookie('id', '', time() - 3600);
setcookie('key', '', time() - 3600);

// echo "<script>
//         alert('Berhasil keluar');
//         document.location.href='login.php';
//     </script>";

header("location:login.php");
exit;
