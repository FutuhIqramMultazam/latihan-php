<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "phpdasar");


// cek apakah masih ada cookie?
if (isset($_COOKIE["id"]) && isset($_COOKIE["key"])) {
    $id = $_COOKIE["id"];
    $key = $_COOKIE["key"];

    // ambil username berdasarkan id
    $result = mysqli_query($conn, "SELECT username from user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username
    if ($key === hash('sha256', $row["username"])) {
        $_SESSION["masuk"] = true;
    }
}


if (isset($_SESSION["masuk"])) {
    header("location:index.php");
    exit;
}


if (isset($_POST["login"])) {
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    // cek username
    if (mysqli_num_rows($result) === 1) {
        // cek passsword
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {

            //set session
            $_SESSION["masuk"] = true;

            //set cookie
            if (isset($_POST["remember"])) {

                // buat cookie
                setcookie('id', $row["id"], time() + 120);
                setcookie('key', hash('sha256', $row["username"]), time() + 120);
            }
            header("location:index.php");
            exit;
        } else {
            $salahsandi = true;
        }
    } else {
        $salahnama = true;
    }
}



// query untuk melihat user
$resultforsee = mysqli_query($conn, "SELECT username FROM user");

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
            background-image: url(img/bg-data.jpeg);
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
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
            top: 5px;
            left: 130px;
        }

        .yang-daftar {
            top: 8px;
            right: 10px;
            font-size: 14px;
            background-color: #545050;
            color: white;
            padding: 3px 10px;
            border-radius: 5px;
            transition: 0.2s;
        }

        .yang-daftar:hover {
            background-color: gray;
        }

        #bg:hover {
            cursor: pointer;
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
                    </div>
                    <form action="" method="post">
                        <div class="mb-3">
                            <?php if (isset($salahnama)) : ?>
                                <div class="position-absolute m-3 salahnama alert alert-danger d-flex align-items-center" role="alert">
                                    <i class="bi bi-exclamation-triangle text-danger me-2"></i>
                                    <div>
                                        Username tidak terdaftar
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
                            <input name="username" type="text" class="form-control" id="username" placeholder="Username">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input name="password" type="password" class="form-control" id="password" placeholder="Password">
                                <span id="bg" class="input-group-text ">
                                    <i class="bi bi-eye-slash" id="liat"></i>
                                </span>
                            </div>
                        </div>
                        <div class="mb-2 ">
                            <label for="remember" class="">Ingat saya</label>
                            <input name="remember" class="form-check-input" type="checkbox" id="remember">
                        </div>
                        <button type="submit" name="login" class="mt-3 btn btn-success">Masuk</button>
                        <div class="mt-3">
                            <a href="#" class="text-decoration-none hover-line">Lupa kata sandi anda?</a>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 sign-up-form">
                    <h2>Assalamualaikum, Hai!</h2>
                    <p>Jika anda belum memiliki akun, silahkan membuatnya dengan memencet tombol link di bawah ini.</p>
                    <div class="text-center">
                        <a href="http://localhost/My%20All%20Project/latihan%20PHP/registrasi.php" class="btn btn-primary w-50 "><i class="bi bi-person-plus"></i> Daftar</a>
                        <a href="" data-bs-toggle="modal" data-bs-target="#daftar-user" class="position-absolute yang-daftar text-decoration-none "><i class="bi bi-eye"></i> Users</a>
                    </div>

                    <!-- card modal -->
                    <div class="modal fade" id="daftar-user" tabindex="-1" aria-labelledby="daftar-userLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="daftar-userLabel">Daftar akun yang sudah terdaftar</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <div class="list-group">
                                        <?php while ($seeuser = (mysqli_fetch_assoc($resultforsee))) : ?>
                                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                                <?= $seeuser["username"]; ?>
                                            </a>
                                        <?php endwhile; ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- akhir card modal -->

                </div>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.js"></script>

    <script>
        const password = document.getElementById("password");
        const liat = document.getElementById("liat");
        const bg = document.getElementById("bg");

        bg.addEventListener("click", function() {
            if (password.type === "password") {
                password.type = "text";
                liat.classList.remove("bi-eye-slash");
                liat.classList.add("bi-eye");
            } else {
                password.type = "password";
                liat.classList.remove("bi-eye");
                liat.classList.add("bi-eye-slash");
            }
        });
    </script>

</body>

</html>