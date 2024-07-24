<?php

$conn = mysqli_connect("localhost", "root", "", "phpdasar");

if (isset($_POST["login"])) {
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    // cek username
    if (mysqli_num_rows($result) === 1) {
        // cek passsword
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            header("location:index.php");
            exit;
        }
        $salahsandi = true;
    } else {
        $salahnama = true;
    }
}

?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="icons/bootstrap-icons.css">

    <style>
        body {
            background-color: black;
        }

        a i {
            color: white;
            transition: 0.1s;
        }

        a i:hover {
            color: gray;
            font-size: 20px;
        }

        .sign-in-form {
            padding: 2rem;
        }

        .sign-up-form {
            color: white;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .row {
            border-radius: 10px;
        }

        .wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            /* Menggunakan tinggi viewport untuk kontainer */
        }

        .salahsandi,
        .salahnama {
            top: 0px;
            left: 150px;
        }
    </style>
</head>

<body>

    <div class="container ">
        <div class="wrapper">
            <div class="row bg-dark position-relative">
                <div class="col-md-6 sign-in-form">
                    <h2>Sign in</h2>
                    <div class="d-flex justify-content-center">
                        <a href="#"><i class="bi bi-facebook mx-2"></i></a>
                        <a href="#"><i class="bi bi-google mx-2"></i></a>
                        <a href="#"><i class="bi bi-linkedin mx-2"></i></a>
                    </div>
                    <form action="" method="post">
                        <div class="mb-3">
                            <?php if (isset($salahnama)) : ?>
                                <div class="position-absolute m-3 salahnama alert alert-danger d-flex align-items-center" role="alert">
                                    <i class="bi bi-exclamation-triangle text-danger me-2"></i>
                                    <div>
                                        Username salah atau tidak terdaftar
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if (isset($salahsandi)) : ?>
                                <div class="position-absolute m-3 salahsandi alert alert-danger d-flex align-items-center" role="alert">
                                    <i class="bi bi-exclamation-triangle text-danger me-2"></i>
                                    <div>
                                        Password yang anda masukan salah
                                    </div>
                                </div>
                            <?php endif; ?>
                            <label for="username" class="form-label">Username</label>
                            <input name="username" type="text" class="form-control" id="username" placeholder="username">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input name="password" type="password" class="form-control" id="password" placeholder="Password">
                        </div>
                        <div class="mb-3">
                            <a href="#" class="text-decoration-none">Lupa kata sandi anda?</a>
                        </div>
                        <button type="submit" name="login" class="btn btn-success">Masuk</button>
                    </form>
                </div>
                <div class="col-md-6 sign-up-form">
                    <h2>Assalamualaikum, Hai!</h2>
                    <p>Jika anda belum memiliki akun, silahkan membuatnya dengan memencet tombol di bawah ini</p>
                    <a href="http://localhost/My%20All%20Project/latihan%20PHP/registrasi.php" class="btn btn-primary">Daftar</a>
                </div>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.js"></script>

</body>

</html>