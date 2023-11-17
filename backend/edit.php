<?php
$DBHOST = 'localhost';
$DBUSER = 'root';
$DBPASSWORD = '';
$DBNAME = 'pemweb-db';

$conn = new mysqli($DBHOST, $DBUSER, $DBPASSWORD, $DBNAME);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}


$id = $_GET["id"];
$sql = "SELECT * FROM products WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa</title>
</head>

<body>
    <h2>Edit Data Mahasiswa</h2>

    <form action="backend/update.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label for="name">Nama: </label>
        <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br>

        <label for="price">Harga: </label>
        <input type="text" name="price" value="<?php echo $row['price']; ?>" required><br>

        <label for="image">Gambar: </label>
        <input type="file" name="image" required><br>

        <button type="submit" name="submit">Simpan Perubahan</button>
    </form>

    <?php
    // Tutup koneksi
    $conn->close();
    ?>
</body>

</html>