<?php

session_start();

if (!isset($_SESSION["masuk"])) {
    header("location:login.php");
    exit;
}

$conn = mysqli_connect("localhost", "root", "", "dbicam");

$result = mysqli_query($conn, "SELECT * FROM daftar_nama ");

// cari nama
if (isset($_POST["cari"])) {
    $nama = htmlspecialchars($_POST["nama"]);
    $result = mysqli_query($conn, "SELECT * FROM daftar_nama WHERE nama Like '%$nama%'");
}

// insert nama
if (isset($_POST["add"])) {
    // var_dump($_POST);
    // var_dump($_FILES);
    // die;
    $nama = htmlspecialchars($_POST["nama"]);
    $jk = htmlspecialchars($_POST["jk"]);
    $usia = htmlspecialchars($_POST["usia"]);
    $namaFile = htmlspecialchars($_FILES['gambar']['name']); // nama file yang kita upload, contoh 'gunung.png'
    $ukuranFile = $_FILES['gambar']['size']; // ukuran penyimpanan gambar
    $error = $_FILES['gambar']['error']; // mengecek error
    $tmpName = $_FILES['gambar']['tmp_name']; // temp

    // pengecekan form, jika salah satu form tidak di isi 
    if (empty($nama)) {
        echo "<script>
        alert('isi nama terlebih dahulu!');
        document.location.href = 'index.php';
        </script>";
        exit;
    }
    if (empty($jk)) {
        echo "<script>
        alert('isi jenis kelamin terlebih dahulu!');
        document.location.href = 'index.php';
        </script>";
        exit;
    }
    if (empty($usia)) {
        echo "<script>
        alert('isi usia terlebih dahulu!');
        document.location.href = 'index.php';
        </script>";
        exit;
    }

    //cek apakah tidak ada gambar yang di upload?
    if ($error === 4) {
        echo "<script>
        alert('pilih gambar terlebih dahulu!');
        document.location.href = 'index.php';
        </script>";
        exit;
    }

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
    // var_dump($namaFileBaru);
    // die;

    move_uploaded_file($tmpName, 'img/' . $gambar);

    $query = "INSERT INTO daftar_nama (nama,jeniskelamin,usia,gambar) VALUES ('$nama','$jk','$usia','$gambar')";
    mysqli_query($conn, $query);
    echo "<script>
    alert('Date Succes to add');
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
    <title>Daftar_nama</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="icons/bootstrap-icons.css">
    <style>

    </style>
</head>

<body>
    <nav class="navbar bg-black fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Data Daftar nama</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <!-- <span class="navbar-toggler-icon"></span> -->
                <i class="bi bi-person-plus-fill"></i>
                <i class="bi bi-three-dots"></i>
                <i class="bi bi-box-arrow-left"></i>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Tambah data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">

                    <!-- tambah data -->
                    <span class="input-group-text"><i class="bi bi-person"><i class="bi bi-body-text"></i></i></span>
                    <form class="d-blok" method="post" action="" enctype="multipart/form-data">
                        <div class="form-floating mb-3">
                            <input class="form-control me-2 mb-2 " type="text" placeholder="Masukan nama" name="nama" autocomplete="off">
                            <label>isi nama</label>
                        </div>
                        <!-- <input class="form-control me-2 mb-2 " type="text" placeholder="Masukan gender" name="jk" autocomplete="off"> -->
                        <span class="input-group-text"><i class="bi bi-gender-ambiguous"></i></span>
                        <div class="form-floating mb-3">
                            <select name="jk" class="form-select mb-3" id="floatingSelect" aria-label="Floating label select example">
                                <option value="Pria">Pria<i class="bi bi-person-standing"></i></option>
                                <option value="Wanita">Wanita</option>
                            </select>
                            <label for="floatingSelect">Pilih Jenis Kelamin</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input class="form-control me-2 mb-2 " type="number" placeholder="Berapa usia anda?" name="usia" autocomplete="off">
                            <label>Masukan usia anda</label>
                        </div>
                        <input class="form-control me-2 mb-2 " type="file" placeholder="Masukan gambar" name="gambar" autocomplete="off">
                        <button class="btn btn-success w-100" type="submit" name="add"><i class="bi bi-person-fill-add"></i>Tambah</button>
                    </form>
                </div>
                <div class="mb-3 justify-content-md-end text-center">
                    <a href="logout.php" class="btn btn-outline-danger" type="button"><i class="bi bi-door-open"></i> Keluar</a>
                </div>
            </div>
        </div>
    </nav>


    <!-- cari nama -->
    <section class="search" id="search">
        <div class="container pt-5">
            <div class="row mt-5">
                <div class="col-md-6 offset-md-3">
                    <form class="d-flex" role="search" action="" method="post">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person-lines-fill"></i>
                            </span>
                            <input class="form-control me-2 " type="search" autofocus placeholder="Cari Username" aria-label="Search" name="nama" autocomplete="off">
                        </div>
                        <button class="btn btn-outline-success" type="submit" name="cari"><i class="bi bi-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </section>



    <!-- tabel data -->
    <div class="container-fluid my-5">
        <div class="row">
            <div class="col-md-12">
                <table class="table text-center table-bordered border-dark">
                    <thead>
                        <tr>
                            <th scope="col"><i class="bi bi-list-ol"></i> #</th>
                            <th scope="col"><i class="bi bi-image"></i> Gambar</th>
                            <th scope="col"><i class="bi bi-person-vcard"></i> Nama</th>
                            <th scope="col"><i class="bi bi-gender-ambiguous"></i> Gender</th>
                            <th scope="col"><i class="bi bi-calendar-check"></i> Usia</th>
                            <th scope="col"><i class="bi bi-tools"></i> Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php $i = 1;
                        while ($row = (mysqli_fetch_assoc($result))) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><img class="rounded " style="width: 50px;" src="img/<?= $row["gambar"]; ?>"></td>
                                <td><?= $row["nama"]; ?></td>
                                <td><?= $row["jeniskelamin"]; ?></td>
                                <td><?= $row["usia"]; ?></td>
                                <td><a class="btn btn-info btn-sm" href="ubah.php?id=<?= $row["id"]; ?>" role="button"><i class="bi bi-pencil-square"></i> Ubah</a> |
                                    <a class="btn btn-danger btn-sm" href="hapus.php?id=<?= $row["id"]; ?>" role="button" onclick="return confirm('Are you sure?');"><i class="bi bi-trash3"></i> Hapus</a>
                                </td>
                            </tr>
                        <?php $i++;
                        endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>