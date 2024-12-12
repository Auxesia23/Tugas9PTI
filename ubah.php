<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Fashion</title>
</head>
<body>

<h1>Ubah Baju</h1>

<?php
if (isset($_GET["id"])) {
    // Prevent SQL Injection: Ensure 'id' is an integer
    $id_produk = (int) $_GET["id"];

    // Fetch the product details to edit
    $sql = "SELECT * FROM produk WHERE id_produk = $id_produk";
    $result = $conn->query($sql);
    $produk = mysqli_fetch_assoc($result);
}

if (isset($_POST["submit"])) {
    // Prevent SQL Injection: Ensure the data is sanitized and valid
    $nama = mysqli_real_escape_string($conn, $_POST["nama"]);
    $harga = (int) $_POST["harga"]; // Ensure the price is an integer
    $id = (int) $_POST["id"];

    // Update the product
    $sql = "UPDATE produk SET nama_produk = '$nama', harga = '$harga' WHERE id_produk = $id";
    
    if ($conn->query($sql) === TRUE) {
        // Redirect after successful update
        header('Location: index.php'); // Adjust this URL if necessary
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<form action="#" method="post">
    <input type="hidden" name="id" value="<?= isset($produk['id_produk']) ? $produk['id_produk'] : ''; ?>">
    <table>
        <tr>
            <td width="100px">Nama</td>
            <td><input type="text" name="nama" placeholder="Masukkan nama produk" value="<?= isset($produk['nama_produk']) ? htmlspecialchars($produk['nama_produk']) : ''; ?>"></td>
        </tr>
        <tr>
            <td width="100px">Harga</td>
            <td><input type="text" name="harga" placeholder="Masukkan harga produk" value="<?= isset($produk['harga']) ? htmlspecialchars($produk['harga']) : ''; ?>"></td>
        </tr>
    </table>
    <br>
    <input type="submit" value="Ubah" name="submit" />
</form>

<script>
// Function to confirm delete action
function hapus() {
    if (confirm('Apakah anda yakin ingin menghapus?')) {
        alert('Hapus');
        // Here you can add the delete functionality, if needed
    }
}
</script>

</body>
</html>
