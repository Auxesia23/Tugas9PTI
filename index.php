<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fashion</title>
</head>
<body>

<?php
// Handle the delete action when 'hapus' is set in the query string
if (isset($_GET["hapus"])) {
  // Ensure the id is an integer to avoid SQL injection
  $id_produk = (int) $_GET["hapus"];

  // Query to delete the product from the database
  $sql = "DELETE FROM produk WHERE id_produk = $id_produk";
  if ($conn->query($sql) === TRUE) {
    // Redirect to the admin page after deletion
    header("Location: http://localhost/tokoberkah/admin");
    exit();  // Ensure the script stops after the redirect
  } else {
    echo "Error: " . $conn->error;
  }
}  
?>

<h1>Berkah Fashion - Admin</h1>
<table border="1">
    <tr>
        <th>No</th>
        <th>Foto</th>
        <th>Nama Produk</th>
        <th>Harga</th>
        <th>Aksi</th>
    </tr>

    <?php
    // Fetch all products from the database
    $sql = "SELECT * FROM produk";
    $result = $conn->query($sql);
    $i = 0;
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $i++;
            echo '<tr>
                    <td><center>' . $i . '</center></td>
                    <td><img width="100px" src="image/' . htmlspecialchars($row["foto"]) . '"/></td>
                    <td width="200px">' . htmlspecialchars($row["nama_produk"]) . '</td>
                    <td width="100px">Rp' . number_format($row["harga"], 0, '.', '.') . '</td>
                    <td>
                        <button><a href="ubah.php?id=' . $row["id_produk"] . '">Ubah</a></button>
                        <button onclick="hapus(' . $row["id_produk"] . ', \'' . addslashes($row["nama_produk"]) . '\')">Hapus</button>
                    </td>
                  </tr>';
        }
    } else {
        echo "<tr><td colspan='5'>Belum ada produk</td></tr>";
    }
    ?>
</table>

<br>

<button><a href="tambah.php">Tambah Produk baru</a></button>

<script>
// Function to confirm and delete a product
function hapus(id, nama_produk) {
    if (confirm('Apakah Anda yakin ' + nama_produk + ' akan dihapus?')) {
        window.location.href = 'index.php?hapus=' + id;
    }
}
</script>

</body>
</html>
