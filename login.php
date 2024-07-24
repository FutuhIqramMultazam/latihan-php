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
                    <form>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Password">
                        </div>
                        <div class="mb-3">
                            <a href="#">Lupa kata sandi anda?</a>
                        </div>
                        <button type="submit" class="btn btn-success">Masuk</button>
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