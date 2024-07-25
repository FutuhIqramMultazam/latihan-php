<?php
session_start();

if (!isset($_SESSION["masuk"])) {
    header("location:login.php");
    exit;
}

$conn = mysqli_connect("localhost", "root", "", "dbicam");

$id = $_GET["id"];

$result = mysqli_query($conn, "SELECT * FROM daftar_nama WHERE id = $id ");

$dm = mysqli_fetch_assoc($result);

if (isset($_POST["ubah"])) {
    $nama = htmlspecialchars($_POST["nama"]);

    if (isset($_POST["jk"])) {
        $jk = htmlspecialchars($_POST["jk"]);
    } else {
        $jk = htmlspecialchars($_POST["jklama"]);
    }

    $usia = htmlspecialchars($_POST["usia"]);

    if (empty($nama)) {
        echo "<script>
        alert('nama harus terisi');
        document.location.href = 'index.php';
        </script>";
        exit;
    }
    if (empty($jk)) {

        echo "<script>
        alert('jenis kelamin harus terisi');
        document.location.href = 'index.php';
        </script>";
        exit;
    }
    if (empty($usia)) {
        echo "<script>
        alert('usia harus terisi');
        document.location.href = 'index.php';
        </script>";
        exit;
    }

    if ($_FILES["gambar"]["error"] === 4) {
        $gambar = htmlspecialchars($_POST["gambarLama"]);
    } else {
        $namaFile = htmlspecialchars($_FILES['gambar']['name']); // nama file yang kita upload, contoh 'gunung.png'
        $ukuranFile = $_FILES['gambar']['size']; // ukuran penyimpanan gambar
        $error = $_FILES['gambar']['error']; // mengecek error
        $tmpName = $_FILES['gambar']['tmp_name']; // temp

        // cek apakah yang di upload itu gambar?
        $eksimgvalid = ['jpg', 'jpeg', 'png'];
        $pecahimg = explode('.', $namaFile); // contoh fungsi explode: icam.png = ['icam','png']
        $eksimg = strtolower(end($pecahimg));
        if (!in_array($eksimg, $eksimgvalid)) {
            echo "<script>
        alert('Yang anda upload bukan gambar!');
        document.location.href = 'index.php';
        </script>";
            exit;
        }

        // cek jika ukuran lebih besar dari 2mb
        if ($ukuranFile > 2000000) {
            echo "<script>
        alert('Maaf gambar anda terlalu besar');
        document.location.href = 'index.php';
        </script>";
            exit;
        }

        // lolos pengecekan, gambar siap di upload
        // ubah nama gambar jadi random
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $eksimg;
        $gambar = $namaFileBaru;

        move_uploaded_file($tmpName, 'img/' . $gambar);
    }

    $query = "UPDATE daftar_nama SET nama = '$nama', jeniskelamin = '$jk', usia = '$usia', gambar = '$gambar' WHERE id = $id";
    mysqli_query($conn, $query);
    echo "<script>
    alert('Date Succes to update');
    document.location.href='index.php';
    </script>";
    exit;
}

?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ubah</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>

    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card text-center w-50">
            <div class="card-header">
                <h1>Ubah Data</h1>
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <!-- <input type="hidden" name="id" value="">  ini yang di rekomendasi kan olh padika, tapi ini keamanan nya lemah, bisa di hack lewat inspek-->
                    <div class="d-flex justify-content-center">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="nama" placeholder="ubah nama" value="<?= $dm["nama"]; ?>" style="width: 300px;">
                            <label>Ubah Nama</label>
                        </div>
                    </div>
                    <input type="hidden" name="jklama" value="<?= $dm["jeniskelamin"] ?>">
                    <div class="d-flex justify-content-center mb-3">
                        <select name="jk" class="form-select">
                            <option selected disabled>Pilih Jenis kelamin</option>
                            <option value="Pria">Pria</option>
                            <option value="Wanita">Wanita</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-center ">
                        <div class="form-floating mb-3">
                            <input type="number" name="usia" class="form-control" placeholder="ubah usia" value="<?= $dm["usia"]; ?>" style="width: 300px;">
                            <label for="">Ubah usia?</label>
                        </div>
                    </div>
                    <img src="img/<?= $dm["gambar"]; ?>" class="img-fluid w-25 rounded mb-3">
                    <div class="d-flex justify-content-center mb-3">
                        <input type="file" name="gambar" class="form-control" style="width: 300px;">
                        <input type="hidden" name="gambarLama" value="<?= $dm["gambar"]; ?>">
                    </div>
                    <button class=" btn btn-primary" type="submit" name="ubah">Ubah data</button>
                    <a href="index.php" class="btn btn-outline-danger">Kembali?</a>
                </form>
            </div>
            <div class="card-footer text-body-secondary">
                By Futuh Iqram Multazam
            </div>
        </div>
    </div>
</body>

</html>