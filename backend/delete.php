<?php
require './../config/db.php';

$conn = new mysqli($DBHOST, $DBUSER, $DBPASSWORD, $DBNAME);

if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

$id = $_GET['id'];

$sql = "DELETE FROM products WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil dihapus.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Tutup koneksi
$conn->close();
?>

<br>
<br>
<table border="1">
    <tr>
        <td>
            <a href="../show.php">Kembali</a>
        </td>
    </tr>
</table>