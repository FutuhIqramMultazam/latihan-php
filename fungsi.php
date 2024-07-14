<?php

$conn = mysqli_connect("localhost", "root", '', 'dbicam');

function query($sql)
{
    global $conn;
    $result = mysqli_query($conn, $sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function tambah($data)
{
    global $conn;
    $nama = htmlspecialchars($data['nama']);
    $usia = htmlspecialchars($data['usia']);

    $query = "INSERT INTO daftar_nama values ('$nama','$usia')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM daftar_nama WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function ubah($data)
{
    global $conn;
    // ambil elemen dari tiap form
    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $usia = htmlspecialchars($data["usia"]);

    $query = "UPDATE daftar_nama SET nama = '$nama', usia = '$usia' WHERE id = $id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
