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
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center mt-5">Registrasi</h1>
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
                </form>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>