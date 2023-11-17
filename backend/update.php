<?php
// Konfigurasi koneksi database
require './../config/db.php';

// Buat koneksi ke database
$conn = new mysqli($DBHOST, $DBUSER, $DBPASSWORD, $DBNAME);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}


// Ambil data dari formulir edit.php
$id = $_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];
$image = $_FILES['image'];

 // File upload handling
 $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/pwbuts/upload/';

 // Create the directory if it doesn't exist
 if (!is_dir($uploadDir)) {
     mkdir($uploadDir, 0777, true);
 }

 // Define $randomFilename here
 $randomFilename = time() . '-' . md5(rand()) . '-';

 if ($_FILES['image']['size'] > 0) {
     $image = $_FILES['image']['name'];
     $tempImage = $_FILES['image']['tmp_name'];

     // Append the original file name to $randomFilename
     $randomFilename .= $image;

     $uploadPath = $uploadDir . $randomFilename;

     $upload = move_uploaded_file($tempImage, $uploadPath);

     if ($upload) {
         // Delete the old image file if it exists
         $oldImageQuery = mysqli_query($db_connect, "SELECT image FROM products WHERE id = $id");
         $oldImagePath = mysqli_fetch_assoc($oldImageQuery)['image'];

         if ($oldImagePath) {
             unlink($_SERVER['DOCUMENT_ROOT'] . $oldImagePath);
         }

         // Update the product with the new image path
         mysqli_query($db_connect, "UPDATE products SET name = '$name', price = '$price', image = '/pwbuts/upload/$randomFilename' WHERE id = $id");

         echo "Berhasil mengubah produk dengan gambar baru.";
     } else {
         echo "Gagal mengubah data dengan gambar yang baru.";
     }
 } else {
     // If no new image is uploaded, update the product without changing the image path
     mysqli_query($db_connect, "UPDATE products SET name = '$name', price = '$price' WHERE id = $id");

     echo "Produk berhasil diubah tanpa menggunakan gambar baru.";
 }
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