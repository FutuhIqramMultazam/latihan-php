<?php

if (isset($_POST["buka"])) {
    var_dump(tes($_POST));
}

function tes($post)
{
    $post;
    $gambar = gambar();
    $ary = [$post, $gambar];

    return $ary;
}

function gambar()
{
    $nama = $_FILES["gambar"]["name"];
    $error = $_FILES["gambar"]["error"];
    $tempat = $_FILES["gambar"]["tmp_name"];
    $ukuran = $_FILES["gambar"]["size"];
    $pecah = explode('.', $nama);
    $ambil = strtolower(end($pecah));
    $namai = uniqid();
    $namai .= ".";
    $namai .= $ambil;
    $re = [$namai, $error, $tempat, $ukuran];
    return $re;
}

?>


<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="icons/bootstrap-icons.css">
</head>

<body>



    <form action="" method="post" enctype="multipart/form-data">
        <div class="w-25 mt-3">
            <span class="input-group-text"><i class="bi bi-lock"></i></span>
            <div class=" form-floating position-relative">
                <input class="form-control" type="text" name="nama" placeholder=""><br>
                <label>isi nama</label>
            </div>
        </div>

        <select class="form-select w-25" name="jk" required>
            <option selected disabled>-- Pilih Jenis Kelamin --</option>
            <option value="pria">Pria</option>
            <option value="wanita">Wanita</option>
        </select><br>

        <div class="form-floating mb-3 w-25 ">
            <input type="number" class="form-control" name="usia" id="usia" placeholder="" />
            <label for="usia">Usia</label>
        </div>

        <input class="form-control w-25" type="file" name="gambar"><br>
        <div class="d-grid gap-2 w-25">
            <button type="submit" name="buka" id="buka" class="btn btn-success">
                Button
            </button>
        </div>

    </form>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>


</html>