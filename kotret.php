<?php
require 'fungsi.php';


if (isset($_POST["buka"])) {
    var_dump($_POST);
    var_dump($_FILES);
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
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="nama"><br>

        <select name="jk" required>
            <option selected disabled>-- Pilih Jenis Kelamin --</option>
            <option value="pria">Pria</option>
            <option value="wanita">Wanita</option>
        </select><br>
        <input type="number" name="lahir"><br>
        <input type="file" name="gambar"><br>
        <button name="buka">buka</button>
    </form>

    <div class=" form-floating mb-3 w-25">
        <input type="password" class="form-control" name="sandi" placeholder="" />
        <label class="form-label">Password</label>
    </div>




</body>

</html>