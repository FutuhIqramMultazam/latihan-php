<?php

$dbicam = mysqli_connect("localhost", "root", "", "dbicam");

$result = mysqli_query($dbicam, "SELECT * FROM daftar_buku");

if (isset($_POST["add"])) {
    $penulis = htmlspecialchars($_POST["penulis"]);
    $judul_buku = htmlspecialchars($_POST["judul_buku"]);
    $penerbit = htmlspecialchars($_POST["penerbit"]);
    $tanggal = htmlspecialchars($_POST["tanggal"]);

    if (empty($penulis)) {
        echo "<script>
        alert('Penulis tidak boleh kosong');
        document.location.href = 'daftar_buku.php';
        </script>";
        exit;
    }
    if (empty($judul_buku)) {
        echo "<script>
        alert('Judul buku tidak boleh kosong');
        document.location.href = 'daftar_buku.php';
        </script>";
        exit;
    }
    $query_buku = "INSERT INTO daftar_buku (penulis,judul_buku,penerbit,tanggal) VALUES ('$penulis','$judul_buku','$penerbit','$tanggal')";
    mysqli_query($conn, $query_buku);

    echo "<script>
        alert('Buku telah ditambahkan!');
        document.location.href = 'index.php';
        </script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar_buku</title>
</head>

<body>

</body>

</html>