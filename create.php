<?php
require 'config/db.php';

if(isset($_POST['submit'])) {
    global $db_connect;

    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $tempImage = $_FILES['image']['tmp_name'];

    $randomFilename = time().'-'.md5(rand()).'-'.$image;

    // Menggunakan __DIR__ untuk mendapatkan path yang benar
    $uploadDir = __DIR__ . '/../upload/';
    $uploadPath = $uploadDir . $randomFilename;

    // Cek apakah direktori ada, jika tidak, buat direktori
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0755, true); // Membuat direktori dengan izin 0755
        echo "<div class='alert alert-success'>Direktori upload berhasil dibuat.</div>";
    }

    // Debugging: Periksa apakah direktori dapat ditulis
    if (!is_writable($uploadDir)) {
        echo "<div class='alert alert-danger'>Direktori upload tidak dapat ditulis.</div>";
    } else {
        $upload = move_uploaded_file($tempImage, $uploadPath);

        if($upload) {
            mysqli_query($db_connect, "INSERT INTO products (id, name, price, image) VALUES (NULL, '$name', '$price', '/upload/$randomFilename')");
            echo "<div class='alert alert-success'>Berhasil upload</div>";
        } else {
            echo "<div class='alert alert-danger'>Gagal upload</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Tambah Produk</h1>
        <a href="show.php" class="btn btn-info mb-3">Lihat Data Produk</a>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Nama Produk</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Input nama produk" required>
            </div>
            <div class="form-group">
                <label for="price">Harga Produk</label>
                <input type="number" name="price" id="price" class="form-control" placeholder="Input harga produk" required>
            </div>
            <div class="form-group">
                <label for="image">Gambar Produk</label>
                <input type="file" name="image" id="image" class="form-control-file" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>