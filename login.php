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

        i {
            color: white;
            transition: 0.1s;
        }

        i:hover {
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
    </style>
</head>

<body>
    <!-- Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="errorModalLabel">Gagal Masuk</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Password Salah
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>


    <div class="container ">
        <div class="wrapper">
            <div class="row bg-dark ">
                <div class="col-md-6 sign-in-form">
                    <h2>Sign in</h2>
                    <div class="d-flex justify-content-center">
                        <a href="#"><i class="bi bi-facebook mx-2"></i></a>
                        <a href="#"><i class="bi bi-google mx-2"></i></a>
                        <a href="#"><i class="bi bi-linkedin mx-2"></i></a>
                    </div>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label">username</label>
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