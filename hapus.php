<?php
$conn = mysqli_connect("localhost", "root", "", "dbicam");

$id = $_GET["id"];

mysqli_query($conn, "DELETE FROM daftar_nama WHERE id = '$id'");

echo "<script>
alert('Data berhasil di hapus');
document.location.href = 'index.php';
</script>";
exit;
