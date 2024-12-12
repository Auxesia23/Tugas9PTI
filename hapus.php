<?php
include '.. /koneksi.php';

//Query
$sql = "DELETE FROM produk WHERE id_produk = " . $_GET["id"];
if ($conn->query($sql) === TRUE) {
    header("Location: http://localhost/tokoberkah/cimahi/");
}
