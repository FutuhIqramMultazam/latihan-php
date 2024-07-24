<?php

$conn = mysqli_connect("localhost", "root", "", "phpdasar");

if (isset($_POST["kirim"])) {

    $username = htmlspecialchars(strtolower(stripslashes($_POST["username"])));
    $password = htmlspecialchars(mysqli_real_escape_string($conn, $_POST["password"]));
    $password2 = htmlspecialchars(mysqli_real_escape_string($conn, $_POST["password2"]));

    if (empty($username)) {
        echo "<script>
            alert('Username harus di isi');
            document.location.href='registrasi.php';
            </script>";
        exit;
    }


    // cek konfirmasi nama udah ada apa belum
    $reslut = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    if (mysqli_fetch_assoc($reslut)) {
        echo "<script>
            alert('Username sudah terdaftar');
            document.location.href='registrasi.php';
            </script>";
        exit;
    }

    if (empty($password)) {
        echo "<script>
            alert('Password harus di isi');
            document.location.href='registrasi.php';
            </script>";
        exit;
    }

    if ($password !== $password2) {
        echo "<script>
            alert('Konfirmasi password tidak sesuai');
            document.location.href='registrasi.php';
            </script>";
        exit;
    }

    // acak nama password
    $password = password_hash($password2, PASSWORD_DEFAULT);

    // masukan hasil program kedalam database atau MySQL
    $query = "INSERT INTO user (username,`password`) VALUES ('$username','$password')";
    mysqli_query($conn, $query);

    echo "<script>
    alert('Selamat anda sudah memiliki akun');
    </script>";
}

?>


<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="icons/bootstrap-icons.css">

    <style>
        body {
            background-color: black;
        }

        .wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            /* Menggunakan tinggi viewport untuk kontainer */
        }

        .container {
            margin-top: -20px;
        }

        .bantuan {
            margin-top: 10px;
            display: block;
            text-decoration: none;
        }

        .bantuan:hover {
            text-decoration: underline;
        }

        .modal-footer i {
            color: white;
        }

        .modal-footer i:hover {
            color: gray;
        }
    </style>
</head>

<body>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Petunjuk</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Jika anda memiliki kesulitan dalam mendaftarkan diri yang pertama baca dulu bismillah, jika masih tidak bisa maka hubungi saya melalui link di bawah ini
                </div>
                <div class="modal-footer">
                    <div class="m-auto d-inline-block">
                        <a href="https://instagram.com/futuh_iqram" target="_blank"><i class="h3 me-2 bi bi-instagram"></i></a>
                        <a href="https://github.com/futuhiqrammultazam" target="_blank"><i class="h3 bi bi-github"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- main content -->
    <div class="">
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-6 offset-md-2 bg-dark p-5 mt-5 rounded position-absolute">
                    <!-- button -->
                    <a href="http://localhost/My%20All%20Project/latihan%20PHP/login.php" class="position-absolute top-0 end-0 m-2 btn btn-sm btn-danger position-absloute"><i class="bi bi-backspace"></i> Kembali?</a>
                    <!-- akhir button -->

                    <h1 class="text-center ">Registrasi</h1>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input type="text" class="form-control" id="username" placeholder="Masukkan username" name="username" autocomplete="off">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" class="form-control" id="password" placeholder="Masukkan password" name="password">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Konfirmasi Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-check2-square"></i></span>
                                <input type="password" class="form-control" id="confirmPassword" placeholder="Konfirmasi password" name="password2">
                            </div>
                        </div>
                        <button type="submit" class="mt-4 btn btn-primary w-100" name="kirim">Daftar</button>
                        <a href="#" class="bantuan" data-bs-toggle="modal" data-bs-target="#exampleModal">Petunjuk <i class="bi bi-info-circle-fill"></i></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>