<?php 

require 'fungsi.php';

if(isset($_POST['kirim'])){
    if(tambah($_POST)>0){
        echo "<script>
        alert('data berhasil di tambahkan');
        document.location.href='index.php';
    </script>";
    }else{
        echo "<script>
        alert('data gagal di tambahkan');
        document.location.href='index.php';
    </script>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>Tambah data</h1>
    
<form action="" method="post">
        <input type="text" placeholder="masukan nama" name="nama" >
        <input type="text" placeholder="masukan usia" name="usia" >
        <button name="kirim">kirim</button>
</form>

<h3>
<a href="index.php">batal?</a>
</h3>
</body>
</html>